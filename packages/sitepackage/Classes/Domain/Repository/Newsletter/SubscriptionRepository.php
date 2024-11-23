<?php

namespace MensCircle\Sitepackage\Domain\Repository\Newsletter;

use MensCircle\Sitepackage\Domain\Repository\Traits\StoragePageAgnosticTrait;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class SubscriptionRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = ['start_date' => QueryInterface::ORDER_ASCENDING];
}
