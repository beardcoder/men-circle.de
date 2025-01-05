<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/packages',
    ])

    // add a single rule
    ->withRules([
        NoUnusedImportsFixer::class,
    ])
    ->withPhpCsFixerSets(
        perCS10Risky: true,
        perCS20: true,
        phpCsFixerRisky: true
    )
    // add sets - group of rules
   ->withPreparedSets(
       psr12: true,
       common: true,
       symplify: true,
       cleanCode: true,
       // docblocks: true,
       // comments: true,
   )

;
