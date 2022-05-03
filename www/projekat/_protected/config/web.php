<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'pisio_05',
    'name' => 'OSUNIBL',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\components\Aliases'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
	     'cookieValidationKey' => 'EZIYEAHxg69-K7Ga7qCWbkTTycolnB0-',            
	    
	     'parsers'=>['application/json'=>'yii\web\JsonParser'],
        ],
        // you can set your theme here - template comes with: 'light' and 'dark'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/light/views'],
                'baseUrl' => '@web/themes/light',
            ],
        ],
        'assetManager' => [
            'dirMode' => 02775,
            'fileMode' => 02775,
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'dirMode' => 02775,
            'fileMode' => 02775,

        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<alias:\w+>' => 'site/<alias>',
                ['class'=>'yii\rest\UrlRule','controller'=>'api.user'],
                ['class'=>'yii\rest\UrlRule','controller'=>'api.person'],
                ['class'=>'yii\rest\UrlRule','controller'=>'api.item'],
		['class'=>'yii\rest\UrlRule','controller'=>'api.location'],
		['class'=>'yii\rest\UrlRule','controller'=>'api.room'],
		['class'=>'yii\rest\UrlRule','controller'=>'api.transition'],
		['class'=>'yii\rest\UrlRule','controller'=>'api.building'],

            ],
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
//            'savePath' => '/tmp'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. 
            // You have to set 'useFileTransport' to false and configure a transport for the mailer to send real emails.
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

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
		   // 'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
		    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
 //               'yii' => [
 //                   'class' => 'yii\i18n\PhpMessageSource',
 //                   'basePath' => '@app/translations',
 //                   'sourceLanguage' => 'en'
 //               ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];


$config['modules']['gridview'] = ['class' => '\kartik\grid\Module'];
$config['modules']['datecontrol'] = [
    'class' => 'kartik\datecontrol\Module',
    'displaySettings' => [
        \kartik\datecontrol\Module::FORMAT_DATE => 'dd-MM-yyyy',
        \kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm:ss a',
        \kartik\datecontrol\Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm:ss a',
    ],
];
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = ['class' => 'yii\debug\Module'];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = ['class' => 'yii\gii\Module','allowedIPs' => ['127.0.0.1', '::1', '192.168.100.16', '*'] ];
}

return $config;
