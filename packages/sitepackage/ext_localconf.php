<?php

// Add default RTE configuration

use MensCircle\Sitepackage\Controller\EventController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    static function () {
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:sitepackage/Configuration/RTE/Default.yaml';

        // PageTS
        ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sitepackage/Configuration/TsConfig/Page/All.tsconfig">'
        );

        ExtensionUtility::configurePlugin(
            'Sitepackage',
            'EventList',
            [EventController::class => 'list'],
            [],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
        );

        ExtensionUtility::configurePlugin(
            'Sitepackage',
            'EventDetail',
            [EventController::class => ['detail', 'registration']],
            [EventController::class => ['registration']],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
        );
    }
);
