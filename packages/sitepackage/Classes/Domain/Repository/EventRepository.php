<?php
declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Repository;

use MensCircle\Sitepackage\Domain\Repository\Traits\StoragePageAgnosticTrait;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use function Symfony\Component\Clock\now;

class EventRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = ['start_date' => QueryInterface::ORDER_ASCENDING];

    public function findNextEvents(): QueryResultInterface
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd(
                    $query->greaterThanOrEqual('start_date', now()),
                )
            )
            ->execute();
    }
}
