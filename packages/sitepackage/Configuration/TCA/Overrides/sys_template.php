<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function () {
    /**
     * Temporary variables.
     */
    $extensionKey = 'sitepackage';

    // Default TypoScript for Sitepackage
    ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript',
        'sitepackage'
    );
});
