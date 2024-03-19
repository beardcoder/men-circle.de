<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die('Access denied.');
call_user_func(function () {
    /**
     * Temporary variables
     */
    $extensionKey = 'sitepackage';

    ExtensionUtility::registerPlugin(
    // extension name, matching the PHP namespaces (but without the vendor)
        'Sitepackage',
        // arbitrary, but unique plugin name (not visible in the BE)
        'EventList',
        // plugin title, as visible in the drop-down in the BE
        'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:plugin.event_list',
        // the icon visible in the drop-down in the BE
        'tx-sitepackage-plugin-event-list'
    );

});
