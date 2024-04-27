<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Controller;

use MensCircle\Sitepackage\Domain\Model\Event;
use MensCircle\Sitepackage\Domain\Model\EventRegistration;
use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use MensCircle\Sitepackage\Domain\Repository\EventRegistrationRepository;
use MensCircle\Sitepackage\Domain\Repository\EventRepository;
use MensCircle\Sitepackage\Domain\Repository\FrontendUserRepository;
use Symfony\Component\Uid\Uuid;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class EventController extends ActionController
{
    public function __construct(
        private EventRepository $eventRepository,
        private EventRegistrationRepository $eventRegistrationRepository,
        private FrontendUserRepository $frontendUserRepository
    ) {}

    public function listAction()
    {
        $this->view->assign('events', $this->eventRepository->findNextEvents());

        return $this->htmlResponse();
    }

    public function detailAction(Event $event, ?EventRegistration $eventRegistration = null)
    {
        $eventRegistrationToAssign = $eventRegistration ?? GeneralUtility::makeInstance(EventRegistration::class);

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
            $feUser->setPassword(Uuid::v4()->toHex());
            $this->frontendUserRepository->add($feUser);
        }

        $eventRegistration->setFeUser($feUser);
        $this->eventRegistrationRepository->add($eventRegistration);

        return $this->redirect('detail', null, null, ['event' => $eventRegistration->event]);
    }

    protected function setRegistrationFieldValuesToArguments(): void
    {
        $arguments = $this->request->getArguments();
        if (!isset($arguments['event'])) {
            return;
        }

        /** @var Event $event */
        $event = $this->eventRepository->findByUid((int) $this->request->getArgument('event'));
        if (!is_a($event, Event::class)) {
            return;
        }

        $registrationMvcArgument = $this->arguments->getArgument('eventRegistration');
        $propertyMapping = $registrationMvcArgument->getPropertyMappingConfiguration();

        // Set event to registration (required for validation)
        $propertyMapping->allowProperties('event');
        $propertyMapping->allowCreationForSubProperty('event');
        $propertyMapping->allowModificationForSubProperty('event');
        $arguments['eventRegistration']['event'] = (int) $this->request->getArgument('event');

        $this->request = $this->request->withArguments($arguments);
    }
}
