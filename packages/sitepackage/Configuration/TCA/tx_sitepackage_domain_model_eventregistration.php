<?php

use MensCircle\Sitepackage\Services\LangService;
use MensCircle\Sitepackage\Services\TcaBuilderService;
use nn\t3;

$tca = [
    'ctrl' => TcaBuilderService::makeCtrl(
        'tx_sitepackage_domain_model_eventregistration',
        'first_name',
        'first_name',
        'first_name'
    ),
    'types' => [
        '1' => [
            'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            first_name, last_name, email, fe_user,
                 --div--;'.LangService::transDb('tx_sitepackage_domain_model_eventregistration.tabs.access').',
                    --palette--;;hidden,
                    --palette--;;access,',
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;'.LangService::transDb('tx_sitepackage_domain_model_eventregistration.hidden').'
            ',
        ],
        'access' => [
            'label' => LangService::transDb('tx_sitepackage_domain_model_eventregistration.palettes.access'),
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
            'event' => [
                'config' => [
                    'type' => 'passthrough',
                    'foreign_table' => 'tx_sitepackage_domain_model_event',
                ],
            ],
            'first_name' => [
                'label' => LangService::transDb('tx_sitepackage_domain_model_eventregistration.first_name'),
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],
            'last_name' => [
                'label' => LangService::transDb('tx_sitepackage_domain_model_eventregistration.last_name'),
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],
            'email' => [
                'label' => LangService::transDb('tx_sitepackage_domain_model_eventregistration.email'),
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],
            'fe_user' => [
                'exclude' => true,
                'label' => LangService::transDb('tx_sitepackage_domain_model_eventregistration.fe_user'),
                'config' => [
                    'type' => 'group',
                    'allowed' => 'fe_users',
                    'foreign_table' => 'fe_users',
                    'size' => 1,
                    'minitems' => 0,
                    'maxitems' => 1,
                    'default' => 0,
                    'suggestOptions' => [
                        'default' => [
                            'additionalSearchFields' => 'first_name, last_name, email',
                        ],
                    ],
                ],
            ],
        ]
    ),
];

return $tca;
