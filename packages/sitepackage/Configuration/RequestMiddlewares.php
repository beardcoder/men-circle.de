<?php

declare(strict_types=1);

use B13\SlimPhp\Middleware\SlimInitiator;
use MensCircle\Sitepackage\Middleware\HtmlCompress;
use MensCircle\Sitepackage\Middleware\OutputCache;
use MensCircle\Sitepackage\Middleware\StoreCache;

return [
    'frontend' => [
        'sitepackage-compress-html' => [
            'target' => HtmlCompress::class,
            'before' => [
                'typo3/cms-frontend/output-compression',
            ],
            'after' => [
                'typo3/cms-adminpanel/renderer',
            ],
        ],
        'sitepackage-cache-html' => [
            'target' => StoreCache::class,
            'after' => [
                'typo3/cms-frontend/output-compression',
            ],
        ],
        'sitepackage-cache-output' => [
            'target' => OutputCache::class,
            'after' => [
                'typo3/cms-frontend/site',
            ],
            'before' => [
                'typo3/cms-frontend/base-redirect-resolver',
            ],
        ],
    ],
];
