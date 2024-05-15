<?php

use MensCircle\Sitepackage\Services\EventSlugService;
use MensCircle\Sitepackage\Services\TcaBuilderService;
use nn\t3;

use function Symfony\Component\Clock\now;

return [
    'ctrl' => TcaBuilderService::makeCtrl('tx_sitepackage_domain_model_event', 'title', 'title', 'title'),
    'types' => [
        '1' => [
            'showitem' => implode(',', [
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
                'title, description, image, slug',
                '--palette--;;date',
                '--palette--;;address',
                implode(
                    ',',
                    ['--div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.tabs.registration', 'registration']
                ),
                implode(
                    ',',
                    ['--div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.tabs.access', '--palette--;;hidden', '--palette--;;access']
                ),
            ]),
        ],
    ],
    'palettes' => [
        'address' => [
            'showitem' => 'place, --linebreak--, address, --linebreak--, city, zip, --linebreak--, longitude, latitude',
        ],
        'date' => [
            'showitem' => 'start_date, end_date',
        ],
        'hidden' => [
            'showitem' => '
                hidden;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.hidden
            ',
        ],
        'access' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.palettes.access',
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                --linebreak--,
                fe_group;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:fe_group_formlabel,
            ',
        ],
    ],
    'columns' => t3::TCA()->createConfig(
        'tx_sitepackage_domain_model_event',
        true,
        [
            'title' => [
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.title',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],
            'description' => [
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.description',
                'config' => t3::TCA()->getConfigForType('text'),
            ],
            'image' => [
                'config' => t3::TCA()->getFileFieldTCAConfig('image', ['maxitems' => 1]),
            ],

            'slug' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:pages.slug',
                'displayCond' => 'VERSION:IS:false',
                'config' => [
                    'type' => 'slug',
                    'eval' => 'uniqueInPid',
                    'size' => 50,
                    'appearance' => [
                        'prefix' => EventSlugService::class . '->getPrefix',
                    ],
                    'generatorOptions' => [
                        'fields' => ['title', 'start_date'],
                        'replacements' => [
                            '/' => '-',
                        ],
                        'postModifiers' => [EventSlugService::class . '->modifySlug'],
                    ],
                    'fallbackCharacter' => '-',
                    'default' => '',
                ],
            ],

            'place' => [
                'exclude' => true,
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.place',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],

            'address' => [
                'exclude' => true,
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.address',
                'config' => [
                    'type' => 'input',
                    'size' => 40,
                    'max' => 255,
                    'eval' => 'trim',
                    'required' => true,
                ],
            ],

            'start_date' => [
                'exclude' => true,
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.startdate',
                'config' => [
                    'type' => 'datetime',
                    'default' => now()->getTimestamp(),
                    'required' => true,
                ],
            ],
            'end_date' => [
                'exclude' => true,
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.enddate',
                'config' => [
                    'type' => 'datetime',
                    'default' => now()->getTimestamp(),
                    'required' => true,
                ],
            ],

            'zip' => [
                'exclude' => true,
                'l10n_mode' => 'exclude',
                'l10n_display' => 'defaultAsReadonly',
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.zip',
                'config' => [
                    'type' => 'input',
                    'size' => 4,
                ],
            ],
            'city' => [
                'exclude' => true,
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.city',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim',
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                ],
            ],
            'longitude' => [
                'exclude' => true,
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.longitude',
                'config' => [
                    'type' => 'input',
                    'size' => 11,
                    'max' => 11,
                    'default' => '0.00',
                    'eval' => 'trim',
                ],
            ],
            'latitude' => [
                'exclude' => true,
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.latitude',
                'config' => [
                    'type' => 'input',
                    'size' => 11,
                    'max' => 11,
                    'default' => '0.00',
                    'eval' => 'trim',
                ],
            ],

            'registration' => [
                'exclude' => true,
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.registrations',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_sitepackage_domain_model_eventregistration',
                    'foreign_field' => 'event',
                    'maxitems' => 9999,
                    'appearance' => [
                        'expandSingle' => 1,
                        'levelLinksPosition' => 'bottom',
                        'useSortable' => 1,
                    ],
                ],
            ],
        ]
    ),
];
