<?php
return [
    'BE' => [
        'compressionLevel' => 9,
        'debug' => true,
        'installToolPassword' => '$argon2i$v=19$m=65536,t=16,p=1$SG1DcUpaRmlUNWhQSk9hbw$80/3AsTzsp0+iK/uuXY739fJWzCvCetYZKw375Jd00Y',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8mb4',
                'dbname' => 'db',
                'driver' => 'pdo_mysql',
                'host' => 'db',
                'password' => 'db',
                'port' => 3306,
                'tableoptions' => [
                    'charset' => 'utf8mb4',
                    'collate' => 'utf8mb4_unicode_ci',
                ],
                'user' => 'db',
            ],
        ],
    ],
    'EXTCONF' => [
        'lang' => [
            'availableLanguages' => [
                'de',
            ],
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => 'EXT:sitepackage/Resources/Public/Images/logo-white.svg',
            'loginBackgroundImage' => 'EXT:sitepackage/Resources/Public/Images/Background.jpg',
            'loginFootnote' => '© 2023-2024 Build with ❤️ and mindfulness in Bavaria',
            'loginHighlightColor' => '#b76f2b',
            'loginLogo' => 'EXT:sitepackage/Resources/Public/Images/logo-small.png',
            'loginLogoAlt' => '',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'nnhelpers' => [
            'autoCreateFilemounts' => '1',
            'clearAllCaches' => '0',
            'deeplApiKey' => '',
            'deeplApiUrl' => 'https://api-free.deepl.com/v2/translate',
            'devModeEnabled' => '0',
            'googleGeoApiKey' => '',
            'saltingKey' => '',
            'showMod' => '1',
        ],
        'scheduler' => [
            'maxLifetime' => '1440',
        ],
        'staticfilecache' => [
            'backendDisplayMode' => 'both',
            'boostMode' => '1',
            'cacheTagsEnable' => '0',
            'clearCacheForAllDomains' => '1',
            'debugHeaders' => '0',
            'disableInDevelopment' => '0',
            'enableGeneratorBrotli' => '0',
            'enableGeneratorGzip' => '1',
            'enableGeneratorManifest' => '1',
            'enableGeneratorPhp' => '0',
            'enableGeneratorPlain' => '1',
            'hashUriInCache' => '0',
            'htaccessTemplateName' => 'EXT:staticfilecache/Resources/Private/Templates/Htaccess.html',
            'inlineAssetsFileSize' => '50000',
            'inlineScriptMinify' => '0',
            'inlineServiceFavIcon' => '0',
            'inlineServiceScripts' => '0',
            'inlineServiceStyles' => '0',
            'inlineStyleAssets' => 'ico,png,woff2',
            'inlineStyleMinify' => '0',
            'largeIdentifierInCacheTable' => '0',
            'overrideCacheDirectory' => '',
            'phpTemplateName' => 'EXT:staticfilecache/Resources/Private/Templates/Php.html',
            'rawurldecodeCacheFileName' => '0',
            'renameTablesToOtherPrefix' => '0',
            'sendCacheControlHeaderRedirectAfterCacheTimeout' => '0',
            'sendHttp2PushEnable' => '0',
            'sendHttp2PushFileExtensions' => 'css,js',
            'sendHttp2PushFileLimit' => '10',
            'sendHttp2PushLimitToArea' => '',
            'useFallbackMiddleware' => '1',
            'useReverseUriLengthInPriority' => '1',
            'validFallbackHeaders' => 'Content-Type,Content-Language,Content-Security-Policy,Link,X-SFC-Tags',
            'validHtaccessHeaders' => 'Content-Type,Content-Language,Content-Security-Policy,Link,X-SFC-Tags',
        ],
        'vite_asset_collector' => [
            'defaultManifest' => '_assets/vite/.vite/manifest.json',
            'devServerUri' => 'auto',
            'useDevServer' => 'auto',
        ],
    ],
    'FE' => [
        'compressionLevel' => 9,
        'debug' => false,
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'GFX' => [
        'imagefile_ext' => 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp',
        'processor' => 'GraphicsMagick',
        'processor_allowTemporaryMasksAsPng' => false,
        'processor_colorspace' => 'RGB',
        'processor_effects' => false,
        'processor_enabled' => true,
        'processor_path' => '/usr/bin/',
    ],
    'LOG' => [
        'TYPO3' => [
            'CMS' => [
                'deprecations' => [
                    'writerConfiguration' => [
                        'notice' => [
                            'TYPO3\CMS\Core\Log\Writer\FileWriter' => [
                                'disabled' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'MAIL' => [
        'templateRootPaths' => [
            500 => 'EXT:sitepackage/Resources/Private/Templates/Email',
        ],
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/local/bin/mailpit sendmail -t --smtp-addr 127.0.0.1:1025',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'hash' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'imagesizes' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'pages' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'rootline' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
            ],
        ],
        'devIPmask' => '*',
        'displayErrors' => 1,
        'encryptionKey' => '7bf24e59234ae81bb2875eac483d6a45ff37b012bbca68ddc75eb5dd9d94718bdf647f1f363466ba3317e8a5377a3b37',
        'exceptionalErrors' => 12290,
        'sitename' => 'Men\'s Circle Niederbayern',
        'systemMaintainers' => [
            1,
        ],
        'trustedHostsPattern' => '.*.*',
    ],
];
