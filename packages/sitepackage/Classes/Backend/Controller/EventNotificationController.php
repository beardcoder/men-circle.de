<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Backend\Controller;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Model\EventNotification;
use MensCircle\Sitepackage\Domain\Model\EventRegistration;
use MensCircle\Sitepackage\Domain\Repository\EventNotificationRepository;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Template\Components\Menu\MenuItem;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;

#[AsController]
class EventNotificationController extends ActionController
{
    private ModuleTemplate $moduleTemplate;

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly PageRenderer $pageRenderer,
        private readonly EventNotificationRepository $eventNotificationRepository,
        private readonly MailerInterface $mailer,
        private readonly UriBuilder $backendUriBuilder,
        private readonly EventRepository $eventRepository
    ) {}

    public function prepareTemplate(ServerRequestInterface $request): void
    {
        $this->moduleTemplate = $this->moduleTemplateFactory->create($request);
    }

    /**
     * @throws RouteNotFoundException
     */
    private function setDocHeader(ServerRequestInterface $request): void
    {
        $params = $request->getQueryParams();
        $menuRegistry = $this->moduleTemplate->getDocHeaderComponent()->getMenuRegistry();

        // Create a menu and set its identifier
        $menu = $menuRegistry->makeMenu();
        $menu->setIdentifier('select-event');

        // Fetch events
        $events = $this->eventRepository->findAll();
        if (empty($events)) {
            return; // Exit early if no events exist
        }

        // Build menu items for each event
        foreach ($events as $event) {
            if (!$event instanceof Event) {
                continue; // Skip invalid items if necessary
            }

            $menu->addMenuItem(
                $menu->makeMenuItem()
                    ->setTitle($event->getLongTitle())
                    ->setActive(
                        isset($params['event']) && $event->getUid() === (int)$params['event']
                    )
                    ->setHref(
                        $this->backendUriBuilder->buildUriFromRoute(
                            'events_notification.EventNotification_new',
                            ['event' => $event->getUid()]
                        )
                    )
            );
        }

        // Add menu to registry
        $menuRegistry->addMenu($menu);
    }


    public function listAction(): ResponseInterface
    {
        $this->prepareTemplate($this->request);

        $this->moduleTemplate->setTitle('Select Event');
        $this->moduleTemplate->assign('events', $this->eventRepository->findAll());
        return $this->htmlResponse($this->moduleTemplate->render('Backend/EventNotification/List'));
    }

    /**
     * @throws RouteNotFoundException
     */
    public function newAction(Event $event, ?EventNotification $eventNotification = null): ResponseInterface
    {
        $this->prepareTemplate($this->request);
        $this->setDocHeader($this->request);
        $this->pageRenderer->loadJavaScriptModule('@mens-circle/sitepackage/bootstrap.js');
        $this->pageRenderer->addCssFile('EXT:sitepackage/Resources/Public/Backend/Styles/bootstrap.css');

        $this->moduleTemplate->assign('event', $event);
        $eventNotification ??= GeneralUtility::makeInstance(EventNotification::class);
        assert($eventNotification instanceof EventNotification);

        $eventNotification->event = $event;
        $this->moduleTemplate->assign('eventNotification', $eventNotification);
        $this->moduleTemplate->setTitle('Notification');

        return $this->htmlResponse($this->moduleTemplate->render('Backend/EventNotification/New'));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws IllegalObjectTypeException
     */
    public function sendAction(EventNotification $eventNotification): ResponseInterface
    {
        $event = $eventNotification->event;
        $eventNotification->setPid($event->getPid());
        $this->eventNotificationRepository->add($eventNotification);
        $objectStorage = $event->getParticipants();

        $emailAddresses = array_map(static fn(EventRegistration $eventRegistration): Address => new Address($eventRegistration->getEmail(), $eventRegistration->getName()), $objectStorage->toArray());

        $fluidEmail = new FluidEmail();
        $fluidEmail
            ->bcc(...$emailAddresses)
            ->from(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->subject($eventNotification->subject)
            ->format(FluidEmail::FORMAT_BOTH)
            ->to(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->setTemplate('EventNotification')
            ->assign('subject', $eventNotification->subject)
            ->assign('message', $eventNotification->message);

        $this->mailer->send($fluidEmail);

        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier();

        $message = GeneralUtility::makeInstance(
            FlashMessage::class,
            '',
            'Email Versendet',
            ContextualFeedbackSeverity::OK,
            true
        );
        $messageQueue->addMessage($message);

        return $this->redirect('list');
    }

    protected function initializeModuleTemplate(
        ServerRequestInterface $serverRequest,
    ): ModuleTemplate {
        return $this->moduleTemplateFactory->create($serverRequest);
    }
}
