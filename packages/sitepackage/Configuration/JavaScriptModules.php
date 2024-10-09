<?php

declare(strict_types=1);

return [
    'dependencies' => ['core', 'backend'],
    'imports' => [
        '@mens-circle/sitepackage/' => [
            'path' => 'EXT:sitepackage/Resources/Public/Backend/Scripts/',
            'exclude' => [
                'EXT:EXT:sitepackage/Resources/Public/Backend/Scripts/Contrib/',
            ],
        ],
    ],
];
