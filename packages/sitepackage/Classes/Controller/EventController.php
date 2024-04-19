<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Controller;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class EventController extends ActionController
{
    public function __construct(private EventRepository $eventRepository) {}

    public function listAction()
    {
        $this->view->assign('events', $this->eventRepository->findNextEvents());
        return $this->htmlResponse();
    }

    public function detailAction(Event $event)
    {
        $this->view->assign('event', $event);
        return $this->htmlResponse();
    }
}
