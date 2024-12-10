<?php

use MensCircle\Sitepackage\Enum\SubscriptionStatusEnum;

return [
    'ctrl' => [
        'title' => 'Newsletter Subscription',
        'label' => 'email',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'email, first_name, last_name, status',
        'typeicon_classes' => [
            'default' => 'tx-sitepackage-domain-model-subscription',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => implode(',', [
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
                'email, first_name, last_name, fe_user',
                '--palette--;Dates;dates',
                'double_opt_in_token, status, newsletter',
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
                '--palette--;;hidden',
            ]),
        ],
    ],
    'palettes' => [
        'dates' => [
            'showitem' => 'opt_in_date, double_opt_in_date, opt_out_date, privacy_policy_accepted_date',
        ],
        'hidden' => [
            'showitem' => '
                hidden;LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.hidden
            ',
        ],
    ],
    'columns' => [
        'email' => [
            'label' => 'Email Address',
            'config' => [
                'type' => 'email',
                'size' => 30,
                'required' => true,
            ],
        ],
        'first_name' => [
            'label' => 'First Name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'size' => 30,
                'required' => true,
            ],
        ],
        'last_name' => [
            'label' => 'Last Name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'size' => 30,
                'required' => true,
            ],
        ],
        'fe_user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'size' => 1,
                'default' => 0,
            ],
        ],
        'opt_in_date' => [
            'label' => 'Opt-In Date',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'default' => 0,
            ],
        ],
        'opt_out_date' => [
            'label' => 'Opt-Out Date',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'default' => 0,
            ],
        ],
        'double_opt_in_date' => [
            'label' => 'Double Opt-In Date',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'default' => 0,
            ],
        ],
        'double_opt_in_token' => [
            'label' => 'Double Opt-In Token',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'size' => 40,
                'default' => '',
            ],
        ],
        'privacy_policy_accepted_date' => [
            'label' => 'Privacy Policy Accepted Date',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'default' => 0,
            ],
        ],
        'status' => [
            'label' => 'Subscription Status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array_map(static fn(SubscriptionStatusEnum $subscriptionStatusEnum): array => ['label' => $subscriptionStatusEnum->name, 'value' => $subscriptionStatusEnum->value], SubscriptionStatusEnum::cases()),
                'default' => SubscriptionStatusEnum::Pending->value,
            ],
        ],
        'newsletter' => [
            'label' => 'Newsletter',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_sitepackage_domain_model_newsletter',
                'MM' => 'tx_sitepackage_domain_model_subscription_rel',
                'MM_opposite_field' => 'subscriptions',
                'maxitems' => 99,
                'appearance' => [
                    'showSynchronizationLink' => 1,
                    'showAllLocalizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                ],
            ],
        ],
    ],
];
