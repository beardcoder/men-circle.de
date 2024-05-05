<?php
declare(strict_types=1);


use MensCircle\Sitepackage\Controller\EventController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    static function () {
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:sitepackage/Configuration/RTE/Default.yaml';

        // PageTS
        ExtensionManagementUtility::addPageTSConfig(
            '@import "EXT:sitepackage/Configuration/TsConfig/Page/All.tsconfig"'
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

        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend'] = [
            'backendLogo' => 'EXT:sitepackage/Resources/Public/Images/logo-white.svg',
            'loginBackgroundImage' => 'EXT:sitepackage/Resources/Public/Images/Background.jpg',
            'loginLogo' => 'EXT:sitepackage/Resources/Public/Images/logo-small.png',
            'loginHighlightColor' => '#b76f2b',
            'loginFootnote' => '© 2023-2024 Build with ❤️ and mindfulness in Bavaria',
        ];
    }
);
