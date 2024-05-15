<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Services;

class LangService
{
    public static function transDb(string $key): string
    {
        return 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:' . $key;
    }

    public static function transBe(string $key): string
    {
        return 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:' . $key;
    }

    public static function trans(string $key): string
    {
        return 'LLL:EXT:sitepackage/Resources/Private/Language/locallang.xlf:' . $key;
    }
}
