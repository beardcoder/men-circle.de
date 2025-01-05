<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class EventNotification extends AbstractEntity
{
    public ?Event $event = null;

    public string $subject = '';

    public string $message = '';
}
