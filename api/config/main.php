<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'controllerMap' => [
        'user'=>[
            'class'=>'api\controllers\UserController',
        ],
    ],
    'bootstrap' => ['log'],
    'modules' => [
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => dirname(__DIR__).'/../web/uploads/images/real_photos',//images/store', //path to origin images
            'imagesCachePath' => dirname(__DIR__).'/../web/uploads/images/real_photos/cash',//'images/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
//            'placeHolderPath' => '@webroot/uploads/images/real_photos/real_2.jpg', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],
    ],

    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'multipart/form-data' =>//'yii\web\MultipartFormDataParser',

                    [
                    'class'=>'yii\web\MultipartFormDataParser',
                    'uploadFileMaxCount' => 10,
                    'uploadFileMaxSize' => 20000000
                    ],
                'application/xml' => 'yii\web\XmlParser',
            ],
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
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'auth' => 'site/login',
//                'PUT,POST update' => 'user/update',


//                'GET user' => 'user/index',

//                'PATCH photoimage' => 'photo-image/update',
                'send' => 'site/send-post',
                'POST photoimage' => 'photo-image/create-image',
//                'GET photoimage' => 'photo-image/view',


//
//               //crud  для замков
//                'POST door_lock' => 'door-lock/create',
//                'PUT,PATCH door_lock' => 'door-lock/update',
//                'GET door_lock' => 'door-lock/view',
//                'PUT,PATCH door_lock/delete' => 'door-lock/delete',
//                //crud для электронных ключей
                'POST e-key' => 'key/create-key',
//                'PUT,PATCH e-key' => 'key/update',
                'GET e-key' => 'key/view',
//                'PUT,PATCH e-key/delete' => 'key/delete',
//                //curd для буквенно-цифрового ключа (pin)
//                'POST password' => 'keyboard-pwd/create',
//                'PUT,PATCH password' => 'keyboard-pwd/update',
//                'GET password' => 'keyboard-pwd/view',
//                'PUT,PATCH password/delete' => 'keyboard-pwd/delete',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
            ],
        ],
    ],
    'params' => $params,
];