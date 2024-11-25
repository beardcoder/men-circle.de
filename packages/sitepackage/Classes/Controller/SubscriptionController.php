<?php

namespace MensCircle\Sitepackage\Controller;
use MensCircle\Sitepackage\Domain\Repository\Newsletter\SubscriptionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class SubscriptionController extends ActionController
{

    public function __construct(SubscriptionRepository $subscriptionRepository) {}

    public function subscribeAction(): \Psr\Http\Message\ResponseInterface
    {
        $email = $this->request->getArgument('email');
        // Handle Subscription Logic
        return $this->htmlResponse();
    }

    public function unsubscribeAction(): \Psr\Http\Message\ResponseInterface
    {
        $token = $this->request->getArgument('token');
        // Handle Unsubscription Logic
        return $this->htmlResponse();
    }
}
