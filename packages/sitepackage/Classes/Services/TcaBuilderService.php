<?php

declare(strict_types=1);

namespace MensCircle\Sitepackage\Services;

final class TcaBuilderService
{
    public static function makeCtrl(string $table, string $label, string $sortBy, string $searchFields): array
    {
        return [
            'title' => "LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:$table",
            'label' => $label,
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'delete' => 'deleted',
            'default_sortby' => $sortBy ?? $label,
            'iconfile' => "EXT:sitepackage/Resources/Public/Icons/$table.svg",
            'searchFields' => $searchFields,
            'enablecolumns' => [
                'fe_group' => 'fe_group',
                'disabled' => 'hidden',
                'starttime' => 'starttime',
                'endtime' => 'endtime',
            ],
            'transOrigPointerField' => 'l10n_parent',
            'transOrigDiffSourceField' => 'l10n_diffsource',
            'languageField' => 'sys_language_uid',
            'translationSource' => 'l10n_source',
        ];
    }
}
