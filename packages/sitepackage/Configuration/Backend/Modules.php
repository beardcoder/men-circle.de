<?php

declare(strict_types=1);
use MensCircle\Sitepackage\Backend\Controller\EventNotificationController;

return [
    'web_examples' => [
        'parent' => 'web',
        'position' => ['after' => 'web_info'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/sitepackage/eventNotification',
        'labels' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'Sitepackage',
        'iconIdentifier' => 'module-generic',
        'controllerActions' => [
            EventNotificationController::class => ['new', 'send'],
        ],
    ],
];
