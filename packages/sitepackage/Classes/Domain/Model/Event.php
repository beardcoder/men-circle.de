<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Model;

use DateTime;
use MensCircle\Sitepackage\Enum\EventAttendanceModeEnum;
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
    public string $callUrl = '';
    public bool $cancelled = false;
    public int $attendanceMode = 0;
    public float $longitude = 0.0;
    public float $latitude = 0.0;

    #[Extbase\ORM\Lazy()]
    protected FileReference|LazyLoadingProxy $image;

    /** @var ObjectStorage<EventRegistration> */
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

    public function setRegistration(ObjectStorage $objectStorage): void
    {
        $this->registration = $objectStorage;
    }

    public function isOnline(): bool
    {
        return $this->getRealAttendanceMode() === EventAttendanceModeEnum::ONLINE;
    }

    public function getRealAttendanceMode(): EventAttendanceModeEnum
    {
        return EventAttendanceModeEnum::from($this->attendanceMode);
    }

    public function isOffline(): bool
    {
        return $this->getRealAttendanceMode() === EventAttendanceModeEnum::OFFLINE;
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

    public function setImage(FileReference $fileReference): void
    {
        $this->image = $fileReference;
    }

    public function isCancelled(): bool
    {
        return $this->cancelled;
    }
}
