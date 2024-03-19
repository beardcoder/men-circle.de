<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(
    static function ($cType): void {

        ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                // title
                'label' => "LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.CType.I.features",
                'value' => $cType,
                'icon' => 'content-accordion',
                'group' => 'common',
                'description' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.CType.I.features.description',
            ]
        );

        ExtensionManagementUtility::addTCAcolumns('tt_content', [
            'tx_sitepackage_feature' => [
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tx_sitepackage_feature.title',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_sitepackage_feature',
                    'foreign_field' => 'tt_content',
                    'appearance' => [
                        'useSortable' => true,
                        'showSynchronizationLink' => true,
                        'showAllLocalizationLink' => true,
                        'showPossibleLocalizationRecords' => true,
                        'showRemovedLocalizationRecords' => false,
                        'expandSingle' => true,
                    ],
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                ],
            ],
        ]);

        $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$cType] = 'content-accordion';
        $GLOBALS['TCA']['tt_content']['types'][$cType] = [
            'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
               --palette--;;general,
               header,
               bodytext,
               tx_sitepackage_feature,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
               --palette--;;hidden,
               --palette--;;access,
         ',
            'columnsOverrides' => [
                'image' => [
                    'config' => [
                        'maxitems' => 1,
                    ],
                ],
            ],
        ];
    },
    'features'
);