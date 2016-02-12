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
                'login_bus' => 'site/loginbus',
                'signup' => 'site/signup',
                'signupbusinessman' => 'site/signupbusinessman',
                'signupaccess' => 'site/signupaccess',
                'confirm' => 'site/confirm',
                'logout' => 'site/logout',

                'catalog' => 'catalog/catalog',
                'establishment' => 'catalog/establishment',

                'news' => 'news/news',
                'news_partner' => 'news/newspartner',
                'news_item' => 'news/newsitem',


                'calendar' => 'calendar/calendar',
                'calendar_day' => 'calendar/calendarday',

                'establishment_test' => 'manager/establishmenttest',
                'add_est' => 'manager/addest',
                'event_test' => 'manager/eventtest',
                'add_event' => 'manager/addevent',

                'office' => 'office/office',
                'add_img' => 'office/addestimg',
                'del_img' => 'office/delestimg',
                'add_img_event' => 'office/addimgevent',
                'del_img_event' => 'office/delimgevent',
                'test_event' => 'office/testevent',
                'add_new' => 'office/addnews',
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
