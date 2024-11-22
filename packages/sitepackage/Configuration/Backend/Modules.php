<?php

declare(strict_types=1);

use MensCircle\Sitepackage\Backend\Controller\EventNotificationController;

return [
    'events' => [
        'labels' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_mod_events.xlf',
        'iconIdentifier' => 'event-module',
        'position' => ['after' => 'web'],
    ],
    'events_notification' => [
        'parent' => 'events',
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/sitepackage/eventNotification',
        'labels' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'Sitepackage',
        'iconIdentifier' => 'event-notification-module',
        'controllerActions' => [
            EventNotificationController::class => ['list', 'new', 'send'],
        ],
    ],
];
