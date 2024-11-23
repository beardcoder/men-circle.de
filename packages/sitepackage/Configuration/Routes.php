<?php

use MensCircle\Sitepackage\Controller\SubscriptionController;

return [
    'unsubscribe_newsletter' => [
        'path' => '/newsletter/unsubscribe/{token}',
        'target' => SubscriptionController::class . '::unsubscribeAction'
    ]
];
