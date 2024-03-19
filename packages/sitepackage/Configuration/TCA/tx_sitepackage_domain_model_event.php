<?php

use nn\t3;
use function Symfony\Component\Clock\now;

$tca = [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'default_sortby' => 'title',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/tx_sitepackage_domain_model_event.svg',
        'searchFields' => 'title, description',
        'enablecolumns' => [
            'fe_group' => 'fe_group',
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'languageField' => 'sys_language_uid',
        'translationSource' => 'l10n_source',
    ],
    'types' => [
        '1' => [
            'showitem' =>
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    title, description, image, slug, address, start_date, end_date, zip, city, longitude, latitude, registration,
                 --div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.tabs.access,
                    --palette--;;hidden,
                    --palette--;;access,',
        ],
    ],
    'palettes' => [
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
        'tx_sitepackage_domain_model_event', ['sys_language_uid', 'l10n_parent', 'l10n_source', 'hidden', 'cruser_id', 'pid', 'crdate', 'tstamp', 'sorting', 'starttime', 'endtime', 'fe_group'],
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
                'config' => [
                    'type' => 'text',
                    'enableRichtext' => false,
                    'rows' => 8,
                    'cols' => 40,
                    'max' => 2000,
                    'eval' => 'trim',
                ],
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
                    'size' => 50,
                    'generatorOptions' => [
                        'fields' => ['title'],
                        'replacements' => [
                            '/' => '-',
                        ],
                    ],
                    'fallbackCharacter' => '-',
                    'default' => '',
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
                    'eval' => 'trim'
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
                    'foreign_table' => 'tx_sitepackage_domain_model_event_registration',
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
    )
];

return $tca;