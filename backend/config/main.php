<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'controllerMap' => [
//        'user'=>[
//            'class'=>'common\controllers\UserController',
//        ],
    ],
    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
        'backend\bootstrap\SetUp',
    ],
    'modules' => [
        'Facematica' => [
            'class' => 'backend\modules\faces\FaceRecognition',
        ],
//        'OCR' => [
//            'class' => 'backend\modules\documents\DocumentRecognition',
//        ],
//        'yii2images' => [
//            'class' => 'rico\yii2images\Module',
//            //be sure, that permissions ok
//            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
//            'imagesStorePath' => dirname(__DIR__).'/../web/uploads/images/real_photos',//images/store', //path to origin images
//            'imagesCachePath' => dirname(__DIR__).'/../web/uploads/images/real_photos/cash',//'images/cache', //path to resized copies
//            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
//            'placeHolderPath' => '@webroot/uploads/images/real_photos/real_2.jpg', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
//        ],
    ],
    'components' => [
        'formatter' => [
            // 'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => $params['cookieValidationKey'],

        ],
        'user' => [
            'identityClass' => 'common\auth\Identity',//'reception\entities\User\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity',
                'httpOnly' => true,
                'domain' => $params['cookieDomain']
                ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
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

        // Настройка правил URL для  RESTful API
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'hostInfo' => $params['backendHostInfo'],
            'baseUrl' => '',
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                //['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                '' => 'site/index',
                '/' => 'site/index',
                '<_a:login|logout>' => 'auth/<_a>',
                //'\booking'=>'booking/index',
                '<_c:[\w-]+>' => '<_c>/index',
                '<_c:[\w-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w-]+>/<id:\d+>/<_a:[\w-]+>' => '<_c>/<_a>',
            ],
         ],
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['auth/login', 'site/error','site/index'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['admin','receptionist'],
            ],
        ],
    ],
//    'request' => [
//        'parsers' => [
//            'application/json' => 'yii\web\JsonParser',
//        ]
//    ],
    'params' => $params,
];
