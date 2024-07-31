<?php

use MensCircle\Sitepackage\Constants;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(static function () {
    $name = 'menscircle_text';

    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$name] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$name] = [];
    }

    ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:content_element.text',
            $name,
            'content-sitepackage-text',
            Constants::EXTENSION_NAME
        ]
    );

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$name] = 'content-sitepackage-text';

    $GLOBALS['TCA']['tt_content']['types'][$name] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types'][$name],
        [
            'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                bodytext;
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '
        ]
    );
});
