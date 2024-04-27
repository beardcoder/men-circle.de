<?php

namespace MensCircle\Sitepackage\Services;

class LangService
{
    public static function transDb(string $key)
    {
        return 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:'.$key;
    }

    public static function transBe(string $key)
    {
        return 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:'.$key;
    }

    public static function trans(string $key)
    {
        return 'LLL:EXT:sitepackage/Resources/Private/Language/locallang.xlf:'.$key;
    }
}
