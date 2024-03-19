<?php
/***************
 * Add default RTE configuration
 */

use Benow\Sitepackage\Controller\EventController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:sitepackage/Configuration/RTE/Default.yaml';

/***************
 * PageTS
 */
ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sitepackage/Configuration/TsConfig/Page/All.tsconfig">');

ExtensionUtility::configurePlugin(
    'Sitepackage',
    'EventList',
    [
        EventController::class => 'list',
    ],
    [
        EventController::class => '',
    ]
);