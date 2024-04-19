<?php

declare(strict_types=1);

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function () {
    $extensionKey = 'sitepackage';
    $signature = static fn (string $plugin): string => strtolower(sprintf('%s_%s', str_replace('_', '', $extensionKey), $plugin));

    ExtensionManagementUtility::addTcaSelectItemGroup(
        'tt_content',
        'CType',
        $extensionKey,
        'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:extension.title'
    );

    ExtensionUtility::registerPlugin(
        ucfirst($extensionKey),
        'EventList',
        'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:plugin.event_list',
        'tx-sitepackage-plugin-event-list',
        $extensionKey
    );
    ExtensionUtility::registerPlugin(
        ucfirst($extensionKey),
        'EventDetail',
        'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:plugin.event_detail',
        'tx-sitepackage-plugin-event-list',
        $extensionKey
    );

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'pi_flexform',
        implode(',', [
            $signature('EventList'),
        ]),
        'after:header'
    );

    ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:sitepackage/Configuration/FlexForms/flexform_event_list.xml',
        $signature('EventList')
    );

    $GLOBALS['TCA']['tt_content']['types'][$signature('EventList')] = $GLOBALS['TCA']['tt_content']['types']['header'];
    ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'pi_flexform, pages', $signature('EventList'), 'after:subheader');

    GeneralUtility::makeInstance(Registry::class)->configureContainer(
        (
        new ContainerConfiguration(
            '3cols', // CType
            '3 Column Container With Header', // label
            '', // description
            [
                [
                    ['name' => 'Header', 'colPos' => 210, 'colspan' => 3]
                ],
                [
                    ['name' => 'Left', 'colPos' => 200],
                    ['name' => 'Middle', 'colPos' => 201],
                    ['name' => 'Right', 'colPos' => 202],
                ],
            ] // grid configuration
        )
        )->setIcon('container-3col')
    );

});
