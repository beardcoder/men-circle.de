<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Backend\Controller;

use MensCircle\Sitepackage\Domain\Model\EventNotification;
use MensCircle\Sitepackage\Domain\Model\EventRegistration;
use MensCircle\Sitepackage\Domain\Repository\EventNotificationRepository;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Backend\Attribute\AsController;
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
    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly PageRenderer $pageRenderer,
        private readonly EventNotificationRepository $eventNotificationRepository,
        private readonly MailerInterface $mailer,
    ) {}

    public function newAction(?EventNotification $eventNotification = null): ResponseInterface
    {
        $eventRepository = GeneralUtility::makeInstance(EventRepository::class);
        $moduleTemplate = $this->initializeModuleTemplate($this->request);
        $this->pageRenderer->loadJavaScriptModule('@mens-circle/sitepackage/bootstrap.js');
        $this->pageRenderer->addCssFile('EXT:sitepackage/Resources/Public/Backend/Styles/Contrib/jodit.min.css');
        $this->pageRenderer->addCssFile('EXT:sitepackage/Resources/Public/Backend/Styles/bootstrap.css');

        $moduleTemplate->assign('events', $eventRepository->findAll());
        $eventNotificationAssign = $eventNotification ?? GeneralUtility::makeInstance(EventNotification::class);

        $moduleTemplate->assign('eventNotification', $eventNotificationAssign);
        $moduleTemplate->setTitle('Mail');

        return $moduleTemplate->renderResponse('Backend/EventNotification/New');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws IllegalObjectTypeException
     */
    public function sendAction(?EventNotification $eventNotification = null): ResponseInterface
    {
        $event = $eventNotification->event;
        $eventNotification->setPid($event->getPid());
        $this->eventNotificationRepository->add($eventNotification);
        $participants = $event->getParticipants();

        $emailAddresses = array_map(function (EventRegistration $participant) {
            return new Address($participant->getEmail(), $participant->getName());
        }, $participants->toArray());

        $fluidEmail = new FluidEmail();
        $fluidEmail
            ->bcc(...$emailAddresses)
            ->from(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->subject($eventNotification->subject)
            ->format(FluidEmail::FORMAT_BOTH)
            ->setTemplate('EventNotification')
            ->assign('subject', $eventNotification->subject)
            ->assign('message', $eventNotification->message)
        ;

        $this->mailer->send($fluidEmail);

        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier();

        $message = GeneralUtility::makeInstance(
            FlashMessage::class,
            '',
            'Email Verssendet',
            ContextualFeedbackSeverity::OK,
            true
        );
        $messageQueue->addMessage($message);

        return $this->redirect('new');
    }

    protected function initializeModuleTemplate(
        ServerRequestInterface $serverRequest,
    ): ModuleTemplate {
        return $this->moduleTemplateFactory->create($serverRequest);
    }
}
