<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Controller;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use MensCircle\Sitepackage\Domain\Model\Participant;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use MensCircle\Sitepackage\Domain\Repository\FrontendUserRepository;
use MensCircle\Sitepackage\Domain\Repository\ParticipantRepository;
use MensCircle\Sitepackage\PageTitle\EventPageTitleProvider;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event as CalendarEvent;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Uid\Uuid;
use TYPO3\CMS\Core\Http\PropagateResponseException;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class EventController extends ActionController
{
    public function __construct(
        private readonly EventRepository $eventRepository,
        private readonly ParticipantRepository $participantRepository,
        private readonly FrontendUserRepository $frontendUserRepository,
        private readonly EventPageTitleProvider $eventPageTitleProvider,
        private readonly ImageService $imageService,
        private readonly PageRenderer $pageRenderer,
        private readonly MetaTagManagerRegistry $metaTagManagerRegistry,
    ) {}

    /**
     * @throws \DateMalformedStringException
     * @throws InvalidQueryException
     */
    public function listAction(): ResponseInterface
    {
        $this->view->assign('events', $this->eventRepository->findNextEvents());

        return $this->htmlResponse();
    }

    /**
     * @throws \DateMalformedStringException
     * @throws InvalidQueryException
     */
    public function upcomingAction(?Event $event = null): ResponseInterface
    {
        $upcomingEvent = $event ?? $this->eventRepository->findNextUpcomingEvent();

        if (is_null($upcomingEvent)) {
            return $this->handleEventNotFoundError();
        }

        return $this->redirect(actionName: 'detail', arguments: ['event' => $upcomingEvent]);
    }

    public function detailAction(?Event $event = null, ?Participant $participant = null): ResponseInterface
    {
        $participantToAssign = $participant ?? GeneralUtility::makeInstance(Participant::class);

        if (is_null($event)) {
            return $this->handleEventNotFoundError();
        }

        $this->prepareSeoForEvent($event);

        $this->pageRenderer->addHeaderData($event->buildSchema($this->uriBuilder));

        $this->view->assign('event', $event);
        $this->view->assign('participant', $participantToAssign);

        return $this->htmlResponse();
    }

    /**
     * @throws NoSuchArgumentException
     */
    public function initializeRegistrationAction(): void
    {
        $this->setRegistrationFieldValuesToArguments();
    }

    /**
     * @throws IllegalObjectTypeException
     * @throws TransportExceptionInterface
     */
    public function registrationAction(Participant $participant): ResponseInterface
    {
        $feUser = $this->frontendUserRepository->findOneBy(['email' => $participant->getEmail()]);
        if ($feUser === null) {
            $feUser = $this->mapParticipantToFeUser($participant);
            $this->frontendUserRepository->add($feUser);
        }

        $participant->setFeUser($feUser);
        $this->participantRepository->add($participant);

        $this->addFlashMessage(
            LocalizationUtility::translate(
                'registration.success',
                'sitepackage',
                [$participant->event->startDate->format('d.m.Y')]
            )
        );

        $this->sendMailToAdminOnRegistration($participant);

        $redirectUrl = $this->uriBuilder->reset()->setTargetPageUid(3)->setNoCache(true)->uriFor('detail', ['event' => $participant->event->getUid()]);

        return $this->redirectToUri($redirectUrl);
    }

    /**
     * @throws PropagateResponseException
     * @throws \Exception
     */
    public function iCalAction(Event $event): MessageInterface
    {
        $processedFile = $this->imageService->applyProcessingInstructions(
            $event->getImage()->getOriginalResource(),
            ['width' => '600c', 'height' => '600c']
        );

        $calendarEvent = CalendarEvent::create()
            ->name($event->getLongTitle())
            ->description($event->description)
            ->url($this->getUrlForEvent($event))
            ->image($this->imageService->getImageUri($processedFile, true))
            ->startsAt(new \DateTime($event->startDate->format('d.m.Y H:i')))
            ->endsAt(new \DateTime($event->endDate->format('d.m.Y H:i')))
            ->organizer('markus@letsbenow.de', 'Markus Sommer');

        if ($event->isOffline() && $event->latitude && $event->longitude) {
            $calendarEvent->address($event->getFullAddress(), $event->place)->coordinates($event->latitude, $event->longitude);
        }

        $calendar = Calendar::create($event->getLongTitle())->event($calendarEvent);

        $response = $this->responseFactory->createResponse()
            ->withHeader('Cache-Control', 'private')
            ->withHeader('Content-Disposition', 'attachment; filename="' . $event->getLongTitle() . '.ics"')
            ->withHeader('Content-Type', 'text/calendar; charset=utf-8')
            ->withBody($this->streamFactory->createStream($calendar->get()));

        throw new PropagateResponseException($response, 200);
    }

    /**
     * @throws NoSuchArgumentException
     */
    protected function setRegistrationFieldValuesToArguments(): void
    {
        $arguments = $this->request->getArguments();
        if (!isset($arguments['event'])) {
            return;
        }

        $event = $this->eventRepository->findByUid((int)$this->request->getArgument('event'));
        if (!$event instanceof Event) {
            return;
        }

        $registrationMvcArgument = $this->arguments->getArgument('participant');
        $mvcPropertyMappingConfiguration = $registrationMvcArgument->getPropertyMappingConfiguration();

        // Set event to registration (required for validation)
        $mvcPropertyMappingConfiguration->allowProperties('event');
        $mvcPropertyMappingConfiguration->allowCreationForSubProperty('event');
        $mvcPropertyMappingConfiguration->allowModificationForSubProperty('event');
        $arguments['participant']['event'] = (int)$this->request->getArgument('event');

        $this->request = $this->request->withArguments($arguments);
    }

    private function getUrlForEvent(Event $event): string
    {
        return $this->uriBuilder->reset()->setCreateAbsoluteUri(true)->setTargetPageUid(3)->uriFor('detail', ['event' => $event->getUid()]);
    }

    private function mapParticipantToFeUser(Participant $participant): FrontendUser
    {
        $frontendUser = GeneralUtility::makeInstance(FrontendUser::class);
        assert($frontendUser instanceof FrontendUser);

        $frontendUser->setEmail($participant->getEmail());
        $frontendUser->setFirstName($participant->getFirstName());
        $frontendUser->setLastName($participant->getLastName());
        $frontendUser->setUsername($participant->getEmail());
        $frontendUser->setPassword(Uuid::v4()->toHex());

        return $frontendUser;
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendMailToAdminOnRegistration(Participant $participant): void
    {
        $fluidEmail = new FluidEmail();
        $fluidEmail
            ->to('hallo@mens-circle.de')
            ->from(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->subject('Neue Anmeldung von ' . $participant->getName())
            ->format(FluidEmail::FORMAT_BOTH)
            ->setTemplate('MailToAdminOnRegistration')
            ->assign('participant', $participant);

        $mailer = GeneralUtility::makeInstance(MailerInterface::class);
        assert($mailer instanceof MailerInterface);

        $mailer->send($fluidEmail);
    }

    private function prepareSeoForEvent(Event $event): void
    {
        $this->eventPageTitleProvider->setTitle($event->getLongTitle());

        $processedFile = $this->imageService->applyProcessingInstructions($event->getImage()->getOriginalResource(), ['width' => '600c', 'height' => '600c']);
        $imageUri = $this->imageService->getImageUri($processedFile, true);

        $this->setPageMetaProperty('og:title', $event->getLongTitle());
        $this->setPageMetaProperty('og:description', $event->description);
        $this->setPageMetaProperty('og:image', $imageUri, ['width' => 600, 'height' => 600, 'alt' => $event->getImage()->getOriginalResource()->getAlternative()]);
        $this->setPageMetaProperty('og:url', $this->getUrlForEvent($event));
    }

    private function setPageMetaProperty(string $property, string $value, array $additionalData = []): void
    {
        $this->metaTagManagerRegistry->getManagerForProperty($property)->addProperty($property, $value, $additionalData);
    }

    /**
     * @throws \DateMalformedStringException
     * @throws InvalidQueryException
     */
    private function handleEventNotFoundError(): ResponseInterface
    {
        $upcomingEvent = $this->eventRepository->findNextUpcomingEvent();
        if (is_null($upcomingEvent)) {
            $site = $this->request->getAttribute('site');
            assert($site instanceof Site);

            return $this->redirectToUri($site->getBase(), 301);
        }

        $this->addFlashMessage(
            LocalizationUtility::translate(
                'event.not_found',
                'sitepackage',
            )
        );

        $redirectUrl = $this->uriBuilder->reset()->setTargetPageUid(3)->setNoCache(true)->uriFor('detail', ['event' => $upcomingEvent]);

        return $this->redirectToUri($redirectUrl);
    }
}
