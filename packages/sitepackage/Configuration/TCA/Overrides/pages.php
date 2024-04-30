<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function () {
    /**
     * Temporary variables.
     */
    $extensionKey = 'sitepackage';

    // Default PageTS for Sitepackage
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/All.tsconfig',
        'sitepackage'
    );
});
