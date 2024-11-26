<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    // Icon identifier
    'tx-sitepackage-plugin-event-list' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:sitepackage/Resources/Public/Icons/tx-sitepackage-plugin-event-list.svg',
    ],
    'tx-sitepackage-plugin-newsletter' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:sitepackage/Resources/Public/Icons/tx-sitepackage-plugin-newsletter.svg',
    ],
    'content-sitepackage-text' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:sitepackage/Resources/Public/Icons/Content/Text.svg',
    ],
    'event-notification-module' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:sitepackage/Resources/Public/Icons/EventNotificationModule.svg',
    ],
    'event-module' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:sitepackage/Resources/Public/Icons/EventModule.svg',
    ],
];
