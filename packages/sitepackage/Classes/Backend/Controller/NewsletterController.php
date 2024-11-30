<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Backend\Controller;

use MensCircle\Sitepackage\Domain\Model\Newsletter\Subscription;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use MensCircle\Sitepackage\Domain\Repository\Newsletter\SubscriptionRepository;
use MensCircle\Sitepackage\Enum\SubscriptionStatusEnum;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
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
class NewsletterController extends ActionController
{
    private ModuleTemplate $moduleTemplate;

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly PageRenderer            $pageRenderer,
        private readonly MailerInterface         $mailer,
        private readonly SubscriptionRepository  $subscriptionRepository
    )
    {
    }

    public function prepareTemplate(ServerRequestInterface $serverRequest): void
    {
        $this->moduleTemplate = $this->moduleTemplateFactory->create($serverRequest);
    }

    public function newAction(): ResponseInterface
    {
        $this->prepareTemplate($this->request);
        $this->pageRenderer->loadJavaScriptModule('@mens-circle/sitepackage/bootstrap.js');
        $this->pageRenderer->addCssFile('EXT:sitepackage/Resources/Public/Backend/Styles/bootstrap.css');

        $this->moduleTemplate->setTitle('Newsletter');
        $subscriptions = $this->subscriptionRepository->findBy(['status' => SubscriptionStatusEnum::Active]);
        $this->moduleTemplate->assign('subscriptions', $subscriptions);
        return $this->htmlResponse($this->moduleTemplate->render('Backend/Newsletter/New'));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws IllegalObjectTypeException
     */
    public function sendAction(): ResponseInterface
    {
        $subscriptions = $this->subscriptionRepository->findBy(['status' => SubscriptionStatusEnum::Active]);

        $emailAddresses = array_map(static fn(Subscription $subscription): Address => new Address($subscription->email, $subscription->getName()), $subscriptions->toArray());

        $fluidEmail = new FluidEmail();
        $fluidEmail
            ->bcc(...$emailAddresses)
            ->from(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->subject('subject')
            ->format(FluidEmail::FORMAT_BOTH)
            ->to(new Address('hallo@mens-circle.de', 'Men\'s Circle Website'))
            ->setTemplate('Newsletter')
            ->assign('subject', 'subject')
            ->assign('message', 'message');

        $this->mailer->send($fluidEmail);

        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();

        $flashMessage = GeneralUtility::makeInstance(
            FlashMessage::class,
            '',
            'Email Versendet',
            ContextualFeedbackSeverity::OK,
            true
        );
        $flashMessageQueue->addMessage($flashMessage);

        return $this->redirect('list');
    }

    protected function initializeModuleTemplate(
        ServerRequestInterface $serverRequest,
    ): ModuleTemplate
    {
        return $this->moduleTemplateFactory->create($serverRequest);
    }
}
