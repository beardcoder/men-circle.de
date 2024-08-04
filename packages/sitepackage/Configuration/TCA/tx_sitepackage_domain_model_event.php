<?php

use MensCircle\Sitepackage\Enum\EventAttendanceModeEnum;
use MensCircle\Sitepackage\Service\EventSlugService;

use function Symfony\Component\Clock\now;

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'default_sortby' => 'start_date',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/tx_sitepackage_domain_model_event.svg',
        'searchFields' => 'title',
        'enablecolumns' => [
            'fe_group' => 'fe_group',
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'copyAfterDuplFields' => 'colPos,sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'languageField' => 'sys_language_uid',
        'translationSource' => 'l10n_source',
    ],
    'types' => [
        1 => [
            'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,title, description, attendance_mode, image, call_url, slug, cancelled,--palette--;;date,--palette--;;address,--div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.tabs.registration,registration,--div--;LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.tabs.access,--palette--;;hidden,--palette--;;access',
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
    'columns' => [
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
                'rows' => 2,
                'cols' => 50,
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.image',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'slug' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:pages.slug',
            'displayCond' => 'VERSION:IS:false',
            'exclude' => true,
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
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.place',
            'displayCond' => 'FIELD:attendance_mode:=:0',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'call_url' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.call_url.label',
            'displayCond' => 'FIELD:attendance_mode:=:1',
            'exclude' => true,
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'address' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.address',
            'displayCond' => 'FIELD:attendance_mode:=:0',
            'exclude' => true,
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'start_date' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.startdate',
            'exclude' => true,
            'config' => [
                'type' => 'datetime',
                'default' => now()->getTimestamp(),
                'required' => true,
            ],
        ],
        'end_date' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.enddate',
            'exclude' => true,
            'config' => [
                'type' => 'datetime',
                'default' => now()->getTimestamp(),
                'required' => true,
            ],
        ],
        'zip' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.zip',
            'displayCond' => 'FIELD:attendance_mode:=:0',
            'exclude' => true,
            'config' => [
                'type' => 'input',
                'size' => 4,
            ],
        ],
        'city' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.city',
            'displayCond' => 'FIELD:attendance_mode:=:0',
            'exclude' => true,
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
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.longitude',
            'displayCond' => 'FIELD:attendance_mode:=:0',
            'exclude' => true,
            'config' => [
                'type' => 'input',
                'size' => 11,
                'max' => 11,
                'default' => '0.00',
                'eval' => 'trim',
            ],
        ],
        'latitude' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.latitude',
            'displayCond' => 'FIELD:attendance_mode:=:0',
            'exclude' => true,
            'config' => [
                'type' => 'input',
                'size' => 11,
                'max' => 11,
                'default' => '0.00',
                'eval' => 'trim',
            ],
        ],
        'cancelled' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.cancelled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    0 => [
                        'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.cancelled',
                    ],
                ],
            ],
        ],
        'registration' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.registrations',
            'exclude' => true,
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
        'attendance_mode' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_event.attendance_mode.label',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => EventAttendanceModeEnum::selects(),
            ],
        ],
    ],
];
