<?php

namespace MensCircle\Sitepackage\Service;

use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use MensCircle\Sitepackage\Domain\Model\Newsletter\Subscription;
use MensCircle\Sitepackage\Domain\Model\Participant;
use MensCircle\Sitepackage\Domain\Repository\FrontendUserRepository;
use Symfony\Component\Uid\Uuid;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

readonly class FrontendUserService
{
    public function __construct(
        private FrontendUserRepository $frontendUserRepository,
        private PersistenceManager $persistenceManager,
    ) {}

    public function mapToFrontendUser(Subscription|Participant $model): FrontendUser
    {
        $frontendUser = $this->frontendUserRepository->findOneBy([
            'email' => $model->email,
        ]);

        if (! $frontendUser instanceof FrontendUser) {
            return $this->mapDataToFrontendUser($model);
        }

        return $frontendUser;
    }

    private function mapDataToFrontendUser(Subscription|Participant $data): FrontendUser
    {
        /** @var FrontendUser $frontendUser */
        $frontendUser = GeneralUtility::makeInstance(FrontendUser::class);

        $frontendUser->setEmail($data->email);
        $frontendUser->setFirstName($data->firstName);
        $frontendUser->setLastName($data->lastName);
        $frontendUser->setUsername($data->email);
        $frontendUser->setPassword(Uuid::v4()->toHex());

        $this->frontendUserRepository->add($frontendUser);
        $this->persistenceManager->persistAll();

        return $frontendUser;
    }
}
