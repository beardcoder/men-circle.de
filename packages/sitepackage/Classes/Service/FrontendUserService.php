<?php

namespace MensCircle\Sitepackage\Service;

use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use MensCircle\Sitepackage\Domain\Model\Newsletter\Subscription;
use MensCircle\Sitepackage\Domain\Model\Participant;
use MensCircle\Sitepackage\Domain\Repository\FrontendUserRepository;
use Symfony\Component\Uid\Uuid;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;

readonly class FrontendUserService
{
    public function __construct(private FrontendUserRepository $frontendUserRepository) {}

    /**
     * @throws IllegalObjectTypeException
     */
    public function mapToFrontendUser(Subscription|Participant $model): FrontendUser
    {
        $feUser = $this->frontendUserRepository->findOneBy(['email' => $model->email]);

        if (!$feUser instanceof FrontendUser) {
            $feUser = $this->mapDataToFrontendUser($model);
            $this->frontendUserRepository->add($feUser);
        }

        return $feUser;
    }

    private function mapDataToFrontendUser(Subscription|Participant $data): FrontendUser
    {
        $frontendUser = GeneralUtility::makeInstance(FrontendUser::class);
        assert($frontendUser instanceof FrontendUser);

        $frontendUser->setEmail($data->email);
        $frontendUser->setFirstName($data->firstName);
        $frontendUser->setLastName($data->lastName);
        $frontendUser->setUsername($data->email);
        $frontendUser->setPassword(Uuid::v4()->toHex());

        return $frontendUser;
    }
}
