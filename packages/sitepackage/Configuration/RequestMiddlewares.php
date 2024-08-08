<?php

declare(strict_types=1);

use MensCircle\Sitepackage\Middleware\HtmlCompress;

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
    ],
];
