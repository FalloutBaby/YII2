<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language' => 'ru',
    'id' => 'basic',
    'name' => 'Таск Трекер',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
        app\components\Language::class,],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads',
    ],
    'modules' => [
        'admin' => [
            'class' => app\modules\admin\Admin::class
        ]
    ],
    'components' => [
        'bootstrap' => [
            'class' => \app\components\Language::class
        ],
        'i18n' => [
            'translations' => [
                'task' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                //  'sourceLanguage' => 'ru-Ru',
                ],
                'layout*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                //  'sourceLanguage' => 'ru-Ru',
                ],
                'taskBtn' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                //  'sourceLanguage' => 'ru-Ru',
                ],
            ],
        ],
        'request' => [
// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'r32RDf65pwjIACilQ9fLQl4QZz78VPiU',
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
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin' => 'admin/users',
                'tasks' => 'tasks/index',
                'create' => 'tasks/create',
                'update' => 'tasks/update',
                'delete' => 'tasks/delete',
                'comments/<action>' => 'comments/<action>',
                'tasks/<id>' => 'tasks/view',
                'user-tasks' => 'user-tasks/index',
                '<action>' => 'site/<action>',
                'user-tasks/<action>' => 'user-tasks/<action>',
                '<action>/<id>' => 'site/<action>/view',
            ],
        ],
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
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
