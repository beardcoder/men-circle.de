<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Model;

use MensCircle\Sitepackage\Enum\EventAttendanceModeEnum;
use MensCircle\Sitepackage\Enum\EventStatusEnum;
use Spatie\SchemaOrg\Event as EventSchema;
use Spatie\SchemaOrg\ItemAvailability;
use Spatie\SchemaOrg\Schema;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Service\ImageService;

class Event extends AbstractEntity
{
    public string $slug;

    public string $title;

    public string $description;

    public ?\DateTime $startDate = null;

    public ?\DateTime $endDate = null;

    public ?\DateTime $crdate = null;

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

    /**
     * @var ObjectStorage<Participant>
     */
    #[Extbase\ORM\Lazy()]
    #[Extbase\ORM\Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $registration;

    /**
     * @var ObjectStorage<Participant>
     */
    #[Extbase\ORM\Lazy()]
    #[Extbase\ORM\Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $participants;

    public function __construct()
    {
        $this->registration = new ObjectStorage();
        $this->participants = new ObjectStorage();
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

    public function isCancelled(): bool
    {
        return $this->cancelled;
    }

    public function getLongTitle(): string
    {
        return $this->title . ' am ' . $this->startDate->format('d.m.Y');
    }

    public function buildSchema(UriBuilder $uriBuilder): EventSchema
    {
        $thisUrl = $uriBuilder->reset()
            ->setCreateAbsoluteUri(true)
            ->setTargetPageUid(3)
            ->uriFor('detail', [
                'event' => $this->uid,
            ]);

        $imageService = GeneralUtility::makeInstance(ImageService::class);
        \assert($imageService instanceof ImageService);

        $processedFile = $imageService->applyProcessingInstructions(
            $this->getImage()
                ->getOriginalResource(),
            [
                'width' => '600c',
                'height' => '600c',
            ],
        );

        $place = $this->isOffline() ? Schema::place()
            ->name($this->place)
            ->address(
                Schema::postalAddress()
                    ->streetAddress($this->address)
                    ->addressLocality($this->city)
                    ->postalCode($this->zip)
                    ->addressCountry('DE'),
            ) : Schema::place()->url($this->callUrl);

        $imageUri = $imageService->getImageUri($processedFile, true);
        $baseUrl = $uriBuilder->reset()
            ->setCreateAbsoluteUri(true)
            ->setTargetPageUid(1)
            ->buildFrontendUri();

        return Schema::event()
            ->name(\sprintf('%s am %s', $this->title, $this->startDate->format('d.m.Y')))
            ->description($this->description)
            ->image($imageUri)
            ->startDate($this->startDate)
            ->endDate($this->endDate)
            ->eventAttendanceMode($this->getRealAttendanceMode()->getDescription())
            ->eventStatus(EventStatusEnum::EventScheduled->value)
            ->location($place)
            ->offers(
                Schema::offer()
                    ->validFrom($this->crdate)
                    ->price(0)
                    ->availability(ItemAvailability::InStock)
                    ->url($thisUrl)
                    ->priceCurrency('EUR'),
            )
            ->organizer(Schema::person()->name('Markus Sommer')->url($baseUrl))
            ->performer(Schema::person()->name('Markus Sommer')->url($baseUrl));
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

    public function isOffline(): bool
    {
        return $this->getRealAttendanceMode() === EventAttendanceModeEnum::OFFLINE;
    }

    public function getFullAddress(): string
    {
        return "{$this->address}, {$this->zip} {$this->city}, Deutschland";
    }

    public function setParticipants(ObjectStorage $objectStorage): void
    {
        $this->participants = $objectStorage;
    }

    public function getParticipants(): ObjectStorage
    {
        return $this->participants ?? $this->registration;
    }

    public function addParticipant(Participant $participant): void
    {
        $this->participants->attach($participant);
        $this->registration->attach($participant);
    }

    public function removeParticipant(Participant $participant): void
    {
        $this->participants->detach($participant);
        $this->registration->detach($participant);
    }
}
