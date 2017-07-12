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
    'bootstrap' => [
        'log',
        [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => 'json',
                'application/xml' => 'xml',
            ],
        ],
    ],
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
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 36000 * 24,
            'storageMap' => [
                'user_credentials' => 'common\auth\Identity',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ]
        ]
    ],

    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'multipart/form-data' =>
                    [
                    'class'=>'yii\web\MultipartFormDataParser',
                    'uploadFileMaxCount' => 10,
                    'uploadFileMaxSize' => 20000000
                    ],
                'application/xml' => 'yii\web\XmlParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\auth\Identity',
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
//                'auth' => 'site/login', //старая версия логина
                'POST auth'=>'oauth2/rest/token',
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
                'GET profile' => 'profile/index',
                'GET user' => 'profile/index',

//                'PATCH photoimage' => 'photo-image/update',
                'send' => 'site/send-post',
                'POST photoimage' => 'photo-image/create-image',
//                'GET photoimage' => 'photo-image/view',
                'POST booking' => 'booking/create',
                'GET bookings' => 'booking/bookings',
                'GET booking/view' => 'booking/view',
                'GET booking/view-external' => 'booking/view-external',
                'DELETE booking/delete' => 'booking/delete',

//
//               //crud  для замков
                'POST lock/add' => 'door-lock/create',
//                'PUT,PATCH door_lock' => 'door-lock/update',
                'GET lock/view' => 'door-lock/view',
                'GET lock/viewByMac' => 'door-lock/mac',
//                'PUT,PATCH door_lock/delete' => 'door-lock/delete',
//                //crud для электронных ключей
                'POST e-key' => 'key/create',
                'GET keys' => 'key/index',
//                'PUT,PATCH e-key' => 'key/update',
                'GET e-key' => 'key/view',
//                'PUT,PATCH e-key/delete' => 'key/delete',
//                //curd для буквенно-цифрового ключа (pin)
                'POST password' => 'keyboard-pwd/create',
                'request-password' => 'site/request-password',
//                'PUT,PATCH password' => 'keyboard-pwd/update',
//                'GET password' => 'keyboard-pwd/view',
//                'PUT,PATCH password/delete' => 'keyboard-pwd/delete',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
            ],
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\PhpManager',
//            'itemFile' => '@console/rbac/items.php',
//            'assignmentFile' => '@console/rbac/assignments.php',
//            'ruleFile' => '@console/rbac/rules.php',
//            'defaultRoles' => ['tourist'],
//        ],
    ],
    'as authenticator' => [
        'class' => 'filsh\yii2\oauth2server\filters\auth\CompositeAuth',
        'except' => ['site/index', 'oauth2/rest/token','site/login'],
        'authMethods' => [
            ['class' => 'yii\filters\auth\HttpBearerAuth'],
            ['class' => 'yii\filters\auth\QueryParamAuth', 'tokenParam' => 'accessToken'],
        ]
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['site/index', 'oauth2/rest/token','site/login'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'as exceptionFilter' => [
        'class' => 'filsh\yii2\oauth2server\filters\ErrorToExceptionFilter',
    ],
    'params' => $params,
];