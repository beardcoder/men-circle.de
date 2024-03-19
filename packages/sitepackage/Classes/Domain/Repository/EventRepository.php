<?php
declare(strict_types=1);

namespace Benow\Sitepackage\Domain\Repository;

use Benow\Sitepackage\Domain\Repository\Traits\StoragePageAgnosticTrait;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class EventRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = ['start_date' => QueryInterface::ORDER_ASCENDING];
}