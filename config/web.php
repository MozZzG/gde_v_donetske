<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fh23rgfd6',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'index' => 'site/index',
                'login' => 'site/login',
                'signup' => 'site/signup',
                'signupbusinessman' => 'site/signupbusinessman',
                'signupaccess' => 'site/signupaccess',
                'confirm' => 'site/confirm',
                'logout' => 'site/logout',
                'catalog' => 'site/catalog',
                'news' => 'site/news',
                'news_partner' => 'site/newspartner',
                'news_item' => 'site/newsitem',
                'establishment' => 'site/establishment',
                'establishment_test' => 'site/establishmenttest',
                'calendar' => 'site/calendar',
                'calendar_day' => 'site/calendarday',
                'office' => 'site/office',
                'add_img' => 'site/addestimg',
                'del_img' => 'site/delestimg',
                'add_est' => 'site/addest',
                'add_img_event' => 'site/addimgevent',
                'del_img_event' => 'site/delimgevent',
                'test_event' => 'site/testevent',
                'login_bus' => 'site/loginbus',
                'event_test' => 'site/eventtest',
                'add_event' => 'site/addevent',
                'add_new' => 'site/addnews',
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:F j, Y',
            'datetimeFormat' => 'php:j F, H:i',
            'timeFormat' => 'php:H:i:s',
            'defaultTimeZone' => 'Europe/Moscow',
            'locale' => 'ru-RU'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
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
        'db' => require(__DIR__ . '/db.php'),
        'db_forum' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=forum',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
