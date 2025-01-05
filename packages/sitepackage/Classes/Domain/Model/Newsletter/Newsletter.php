<?php

namespace MensCircle\Sitepackage\Domain\Model\Newsletter;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Newsletter extends AbstractEntity
{
    public string $subject = '';

    public string $message = '';

    /**
     * @var ObjectStorage<Subscription>
     */
    #[Extbase\ORM\Lazy()]
    protected ObjectStorage $subscriptions;

    public function __construct()
    {
        $this->subscriptions = new ObjectStorage();
    }

    /**
     * @param ObjectStorage<Subscription> $objectStorage
     */
    public function setSubscriptions(ObjectStorage $objectStorage): void
    {
        $this->subscriptions = $objectStorage;
    }

    public function getSubscriptions(): ObjectStorage
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): void
    {
        $this->subscriptions->attach($subscription);
    }

    public function removeParticipant(Subscription $subscription): void
    {
        $this->subscriptions->detach($subscription);
    }
}
