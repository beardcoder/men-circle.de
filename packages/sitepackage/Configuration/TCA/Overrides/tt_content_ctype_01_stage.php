<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(
    static function ($cType): void {
        ExtensionManagementUtility::addTCAcolumns('tt_content', [
            'link' => [
                'label' => 'Link',
                'config' => [
                    'type' => 'link',
                    'allowedTypes' => ['page', 'url', 'record'],
                ]
            ],
            'link_title' => [
                'label' => 'Link Text',
                'config' => [
                    'type' => 'input',
                ],
            ],
        ]);

        ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                // title
                'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.CType.I.stage',
                'value' => $cType,
                'icon' => 'content-image',
                'group' => 'common',
                'description' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:tt_content.CType.I.stage.description',
            ]
        );

        $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$cType] = 'content-image';
        $GLOBALS['TCA']['tt_content']['types'][$cType] = [
            'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
               --palette--;;general,
               header,
               link,
               link_title,
               bodytext,
               image,
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
    'stage'
);