<?php

declare(strict_types=1);

return [
    'dependencies' => ['core', 'backend', 'rte_ckeditor'],
    'imports' => [
        '@mens-circle/sitepackage/' => [
            'path' => 'EXT:sitepackage/Resources/Public/Backend/Scripts/',
        ],
    ],
];
