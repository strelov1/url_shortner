<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Url Shortner',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'api1'],
    'modules' => [
        'api1' => [
            'class' => \app\modules\api1\Module::class,
        ],
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/xml' => 'yii\web\XmlParser',
            ],
            'cookieValidationKey' => 'gdfgs435dfocpk-34t5834tyaspkovd&34fdsfcseefgd',
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'application' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                'shorter' => [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['shorter'],
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/shorter.log',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'GET /stats' => 'site/stats',
                'POST /api/v1/create' => 'api1/rest/create',
                '/api/v1/stats' => 'api1/rest/stats',
                'GET /<url:[a-zA-Z0-9-]+>' => 'site/match',
            ],
        ],
        /* Укорачиватель ссылок на основе счетчика
        'shorter' => [
            'class' => \app\components\ShorterWithCounter::class,
            'beginBit' => 1,
            'chars' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
        ],
        */
        'shorter' => [
            'class' => \app\components\ShorterRand::class,
            'length' => 6
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

return $config;
