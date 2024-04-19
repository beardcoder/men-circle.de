<?php

use MensCircle\Sitepackage\Services\TcaBuilderService;
use nn\t3;

$tca = [
    'ctrl' => TcaBuilderService::makeCtrl('tx_sitepackage_domain_model_event_registration', 'firstname,lastname', 'firstname', 'firstname,lastname'),
    'types' => [
        '1' => [
            'showitem' =>
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    ,
                 --div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event_registration.tabs.access,
                    --palette--;;hidden,
                    --palette--;;access,',
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event_registration.hidden
            ',
        ],
        'access' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event_registration.palettes.access',
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                --linebreak--,
                fe_group;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:fe_group_formlabel,
            ',
        ],
    ],
    'columns' => t3::TCA()->createConfig(
        'tx_sitepackage_domain_model_event_registration',
        true,
        [
            'tt_content' => [
                'exclude' => true,
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
            'firstname' => [
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_eventregistration.firstname',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ], 'lastname' => [
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_eventregistration.lastname',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],
        ]
    ),
];

return $tca;
