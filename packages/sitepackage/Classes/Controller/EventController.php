<?php

namespace Benow\Sitepackage\Controller;

use Benow\Sitepackage\Domain\Repository\EventRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class EventController extends ActionController
{

    public function __construct(private EventRepository $eventRepository)
    {
    }

    public function listAction()
    {
        $this->view->assign('events', $this->eventRepository->findAll());
        return $this->htmlResponse();
    }
}