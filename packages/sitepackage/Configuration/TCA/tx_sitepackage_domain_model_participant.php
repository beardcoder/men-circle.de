<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_participant',
        'label' => 'first_name',
        'label_alt' => 'last_name',
        'label_alt_force' => true,
        'default_sortby' => 'first_name',
        'typeicon_classes' => [
            'default' => 'tx-sitepackage-domain-model-participant',
        ],
        'searchFields' => 'first_name',
    ],
    'types' => [
        1 => [
            'showitem' => implode(',', [
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
                'first_name, last_name, email, fe_user',
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
                '--palette--;;hidden',
            ]),
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => 'hidden;LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.hidden',
        ],
    ],
    'columns' => [
        'event' => [
            'config' => [
                'type' => 'passthrough',
                'foreign_table' => 'tx_sitepackage_domain_model_event',
            ],
        ],
        'first_name' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_participant.first_name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'last_name' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_participant.last_name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'email' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_participant.email',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'fe_user' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'items' => [
                    ['label' => null, 'value' => ''],
                ],
                'default' => null,
            ],
        ],
    ],
];
