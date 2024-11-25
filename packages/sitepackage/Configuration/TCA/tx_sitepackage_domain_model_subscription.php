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
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/subscription.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden, email, first_name, last_name, fe_user,
                --palette--;Dates;dates,
                double_opt_in_token, status',
        ],
    ],
    'palettes' => [
        'dates' => [
            'showitem' => 'opt_in_date, double_opt_in_date, opt_out_date, privacy_policy_accepted_date',
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
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_participant.fe_user',
            'config' => [
                'type' => 'group',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'default' => 0,
                'suggestOptions' => [
                    'default' => [
                        'additionalSearchFields' => 'first_name, last_name, email',
                    ],
                ],
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
    ],
];
