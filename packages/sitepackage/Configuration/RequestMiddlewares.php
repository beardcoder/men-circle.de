<?php

declare(strict_types=1);

use MensCircle\Sitepackage\Middleware\HtmlCompress;

return [
    'frontend' => [
        'typo3/cms-frontend/eid' => [
            'disabled' => true,
        ],
        'typo3/cms-frontend/maintenance-mode' => [
            'disabled' => true,
        ],
        'typo3/cms-frontend/output-compression' => [
            'disabled' => true,
        ],
        'typo3/cms-frontend/shortcut-and-mountpoint-redirect' => [
            'disabled' => true,
        ],
        /*'sitepackage-compress-html' => [
            'target' => HtmlCompress::class,
            'before' => [
                'typo3/cms-frontend/output-compression',
            ],
            'after' => [
                'typo3/cms-adminpanel/renderer',
            ],
        ],*/
    ],
];
