<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-botman',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'botman\controllers',
    'language' => 'en',
    'components' => [
        'db' => [
            'charset' => 'utf8mb4', // set character to utf8mb4 to view emoticon character
        ],
        'i18n' => [
            'translations' => [
                'botman' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-botman',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-botman', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the botman
            'name' => 'advanced-botman',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        // specific cache for botman
        'botmanCache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/botman',
        ],
        
    ],
    'params' => $params,
    'defaultRoute' => 'botman/index'
];
