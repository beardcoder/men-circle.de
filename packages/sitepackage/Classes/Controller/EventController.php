<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Controller;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Model\EventRegistration;
use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use MensCircle\Sitepackage\Domain\Repository\EventRegistrationRepository;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use MensCircle\Sitepackage\Domain\Repository\FrontendUserRepository;
use MensCircle\Sitepackage\PageTitle\EventPageTitleProvider;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Uid\Uuid;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class EventController extends ActionController
{
    public function __construct(
        private EventRepository                 $eventRepository,
        private EventRegistrationRepository     $eventRegistrationRepository,
        private FrontendUserRepository          $frontendUserRepository,
        private readonly EventPageTitleProvider $titleProvider
    )
    {
    }

    public function listAction()
    {
        $this->view->assign('events', $this->eventRepository->findNextEvents());

        return $this->htmlResponse();
    }

    public function detailAction(Event $event, ?EventRegistration $eventRegistration = null)
    {
        $eventRegistrationToAssign = $eventRegistration ?? GeneralUtility::makeInstance(EventRegistration::class);
        $this->titleProvider->setTitle($event->title . ' am ' . $event->startDate->format('d.m.Y'));

        $this->view->assign('event', $event);
        $this->view->assign('eventRegistration', $eventRegistrationToAssign);

        return $this->htmlResponse();
    }

    /**
     * Set date format for field dateOfBirth.
     */
    public function initializeRegistrationAction(): void
    {
        $this->setRegistrationFieldValuesToArguments();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws IllegalObjectTypeException
     */
    public function registrationAction(EventRegistration $eventRegistration)
    {
        $feUser = $this->frontendUserRepository->findOneByEmail($eventRegistration->getEmail());
        if (!$feUser) {
            /** @var FrontendUser $feUser */
            $feUser = GeneralUtility::makeInstance(FrontendUser::class);
            $feUser->setEmail($eventRegistration->getEmail());
            $feUser->setFirstName($eventRegistration->getFirstName());
            $feUser->setLastName($eventRegistration->getLastName());
            $feUser->setUsername($eventRegistration->getEmail());
            $feUser->setPassword(Uuid::v4()->toHex());
            $this->frontendUserRepository->add($feUser);
        }

        $eventRegistration->setFeUser($feUser);
        $this->eventRegistrationRepository->add($eventRegistration);

        $this->addFlashMessage(LocalizationUtility::translate(
            'registration.success', 'sitepackage', [$eventRegistration->event->startDate->format('d.m.Y')])
        );

        $this->sendMailToAdminOnRegistration($eventRegistration);

        return (new ForwardResponse('detail'))->withArguments(['event' => $eventRegistration->event, 'success' => true]);
    }

    protected function setRegistrationFieldValuesToArguments(): void
    {
        $arguments = $this->request->getArguments();
        if (!isset($arguments['event'])) {
            return;
        }

        /** @var Event $event */
        $event = $this->eventRepository->findByUid((int)$this->request->getArgument('event'));
        if (!is_a($event, Event::class)) {
            return;
        }

        $registrationMvcArgument = $this->arguments->getArgument('eventRegistration');
        $propertyMapping = $registrationMvcArgument->getPropertyMappingConfiguration();

        // Set event to registration (required for validation)
        $propertyMapping->allowProperties('event');
        $propertyMapping->allowCreationForSubProperty('event');
        $propertyMapping->allowModificationForSubProperty('event');
        $arguments['eventRegistration']['event'] = (int)$this->request->getArgument('event');

        $this->request = $this->request->withArguments($arguments);
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendMailToAdminOnRegistration(EventRegistration $eventRegistration): void
    {
        $email = new FluidEmail();
        $email
            ->to('hallo@mens-circle.de')
            ->from(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->subject('Neue Anmeldung von' . $eventRegistration->getName())
            ->format(FluidEmail::FORMAT_BOTH) // send HTML and plaintext mail
            ->setTemplate('MailToAdminOnRegistration')
            ->assign('eventRegistration', $eventRegistration);
        GeneralUtility::makeInstance(MailerInterface::class)->send($email);
    }
}
