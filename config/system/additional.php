<?php

use TYPO3\CMS\Core\Cache\Backend\RedisBackend;

if ('true' == getenv('IS_DDEV_PROJECT')) {
    $GLOBALS['TYPO3_CONF_VARS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS'],
        [
            'DB' => [
                'Connections' => [
                    'Default' => [
                        'dbname' => 'db',
                        'driver' => 'mysqli',
                        'host' => 'db',
                        'password' => 'db',
                        'port' => '3306',
                        'user' => 'db',
                    ],
                ],
            ],
            // This GFX configuration allows processing by installed ImageMagick 6
            'GFX' => [
                'processor' => 'ImageMagick',
                'processor_path' => '/usr/bin/',
                'processor_path_lzw' => '/usr/bin/',
            ],
            // This mail configuration sends all emails to mailpit
            'MAIL' => [
                'transport' => 'smtp',
                'transport_smtp_encrypt' => false,
                'transport_smtp_server' => 'localhost:1025',
            ],
            'SYS' => [
                'trustedHostsPattern' => '.*.*',
                'devIPmask' => '*',
                'displayErrors' => 1,
            ],
        ]
    );
}

$redisHost = 'redis';
$redisPort = 6379;
$cachesForRedis = [
    'pages' => 86400 * 30,
    'pagesection' => 86400 * 30,
    'hash' => 86400 * 30,
    'rootline' => 86400 * 30,
    'static_cache' => 86400 * 30,
];
$redisDatabaseNumber = 0;
foreach ($cachesForRedis as $cacheName => $lifetime) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheName]['backend'] = RedisBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheName]['options'] = [
        'database' => $redisDatabaseNumber++,
        'hostname' => $redisHost,
        'password' => 'redis',
        'port' => $redisPort,
        'defaultLifetime' => $lifetime,
    ];
}
