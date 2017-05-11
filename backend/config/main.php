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
        'user'=>[
            'class'=>'common\controllers\UserController',
        ],
    ],
    'bootstrap' => ['log'],
    'modules' => [
        'Facematica' => [
            'class' => 'backend\modules\faces\FaceRecognition',
        ],
        'OCR' => [
            'class' => 'backend\modules\documents\DocumentRecognition',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => dirname(__DIR__).'/../web/uploads/images/real_photos',//images/store', //path to origin images
            'imagesCachePath' => dirname(__DIR__).'/../web/uploads/images/real_photos/cash',//'images/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/uploads/images/real_photos/real_2.jpg', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',

            // Включение JSON на прием данных
//            'application/json' => 'yii\web\JsonParser',
//            'parsers' => [
//                'application/json' => 'yii\web\JsonParser',
//            ]
        ],
//        'facematica' => [
//            'class' => 'backend\modules\faces\models\FaceClient',
////            'baseUrl' => 'https://api.facematica.vocord.ru',
////            'API_KEY' => 'fcm3d9fe7b8281bd750d4b852de9a7ab0a5fcm',
//            'local_directory'=> dirname(__DIR__).'/../web/uploads/images/real_photos/'
//        ],
//        'OCR' => [
//            'class' => 'backend\modules\documents\models\FaceClient',
////            'baseUrl' => 'http://cloud.ocrsdk.com',
////            'serviceUrl' => 'http://cloud.ocrsdk.com',
////            'password' => '1qUEQN09CAKveNT64f+UENVk',
////            'applicationId' => 'e-reception',
//            'local_directory'=> dirname(__DIR__).'/../web/uploads/images/document_photos/'
//        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
//            'rules' => [
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
//                '' => 'site/index',
//                '\booking'=>'booking/index',
//                '<_c:[\w-]+>' => '<_c>/index',
//                '<_c:[\w-]+>/<id:\d+>' => '<_c>/view',
//                '<_c:[\w-]+>/<id:\d+>/<_a:[\w-]+>' => '<_c>/<_a>',
//            ],
         ],
    ],
//    'request' => [
//        'parsers' => [
//            'application/json' => 'yii\web\JsonParser',
//        ]
//    ],
    'params' => $params,
];
