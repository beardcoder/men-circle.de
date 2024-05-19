<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Event extends AbstractEntity
{
    public string $slug;
    public string $title;
    public string $description;
    public ?DateTime $startDate = null;
    public ?DateTime $endDate = null;
    public ?DateTime $crdate = null;
    public string $place;
    public string $address;
    public string $zip;
    public string $city;
    public bool $cancelled = false;
    public float $longitude = 0.0;
    public float $latitude = 0.0;

    #[Extbase\ORM\Lazy()]
    protected FileReference|LazyLoadingProxy $image;

    #[Extbase\ORM\Lazy()]
    #[Extbase\ORM\Cascade(['value' => 'remove'])]
    protected ObjectStorage $registration;

    public function __construct()
    {
        $this->registration = new ObjectStorage();
    }

    public function getRegistration(): ObjectStorage
    {
        return $this->registration;
    }

    public function setRegistration(ObjectStorage $registration): void
    {
        $this->registration = $registration;
    }

    public function getImage(): ?FileReference
    {
        if ($this->image instanceof LazyLoadingProxy) {
            /** @var FileReference $image */
            $image = $this->image->_loadRealInstance();
            $this->image = $image;
        }

        return $this->image;
    }

    public function setImage(FileReference $image): void
    {
        $this->image = $image;
    }

    public function isCancelled(): bool
    {
        return $this->cancelled;
    }

    public function setCancelled(bool $cancelled): void
    {
        $this->cancelled = $cancelled;
    }
}
