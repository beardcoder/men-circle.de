<?php

declare(strict_types=1);

use MensCircle\Sitepackage\Domain\Model\FrontendUser;
use MensCircle\Sitepackage\Domain\Model\Newsletter\Subscription;

return [
    FrontendUser::class => [
        'tableName' => 'fe_users',
    ],
    Subscription::class => [
        'tableName' => 'tx_sitepackage_domain_model_subscription',
    ],
];
