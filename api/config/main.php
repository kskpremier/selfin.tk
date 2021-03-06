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
        'common\bootstrap\SetUp',
        'api\bootstrap\SetUp',
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
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24 * 7,
            'storageMap' => [
                'user_credentials' => 'common\auth\Identity',
            ],
            'grantTypes' => [
                'user_credentials' => [
//                    'class' => 'OAuth2\GrantType\UserCredentials',
                //необходимое переопределение механизмы выдачи токенов
                    'class' =>'backend\models\MyUserCredentials'
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'user_credentials' => 'common\auth\Identity',
                    'always_issue_new_refresh_token' => true
                ],
            ],
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
                    'uploadFileMaxSize' => 80000000
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
//                'GET atraveo'=>'atraveo/index',
                'POST auth'=>'oauth2/rest/token',
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
                'GET profile' => 'profile/index',
                'GET user' => 'profile/index',
//                'PATCH photoimage' => 'photo-image/update',
                'send' => 'site/send-post',
                'POST photoimage' => 'photo-image/create-photo',
                'POST document' => 'document/create-document-with-photos',
                'GET document/delete'=>'document/delete',
                'POST mrz' => 'document/create',
               // 'POST document' => 'document/create',
                'POST booking-old' => 'booking/create-old',
                'POST booking' => 'booking/create-for-owner',
                'GET bookings' => 'booking/bookings',
                'GET rents' => 'booking/rents',
                'GET booking/view' => 'booking/view',
                'GET booking/documents' =>'document/get-booking-documents',
                'GET booking/view-external' => 'booking/view-external',
                'DELETE booking/delete' => 'booking/delete',
                'POST myrent'=>'booking/my-rent',
                //crud для  Apartments
                'GET apartments'=> 'booking/apartments',
//               //crud  для замков
                'GET locks' => 'door-lock/index',
                'POST lock/add' => 'door-lock/create',
                'POST lock/name' => 'door-lock/name',
                'PUT,PATCH lock/update' => 'door-lock/update',
                'POST lock/install'=>'door-lock/install',
                'POST lock/uninstall'=>'door-lock/uninstall',
                'GET lock/view' => 'door-lock/view',
                'GET lock/viewByMac' => 'door-lock/mac',
                'PUT,PATCH door_lock/delete' => 'door-lock/delete',
//                //crud для электронных ключей
                'POST e-key' => 'key/create',
                'GET keys' => 'key/keys-list-for-opening',
                'GET key/index' => 'key/list',
                'GET passcodes'=>'keyboard-pwd/index',
//                'PUT,PATCH e-key' => 'key/update',
                'GET e-key' => 'key/view',
//                'PUT,PATCH e-key/delete' => 'key/delete',
//                //curd для буквенно-цифрового ключа (pin)
                'POST passcodes' => 'keyboard-pwd/create',
                'DELETE passcode/delete' => 'keyboard-pwd/delete',
                'PUT passcode/delete' => 'keyboard-pwd/delete',
                'POST key/generate' => 'key/create-for-booking',
                'POST passcodes/create' => 'keyboard-pwd/create',
                'GET passcodes/type'=> 'keyboard-pwd/get-type',
                'request-password' => 'site/request-password',
                'POST add-mobile-user' => 'mobile/create',
                'GET portal-link' => 'booking/get-link',
//                'PUT,PATCH password' => 'keyboard-pwd/update',
//                'GET password' => 'keyboard-pwd/view',
//                'PUT,PATCH password/delete' => 'keyboard-pwd/delete',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
            ],
        ],
    ],
    'as authenticator' => [
        'class' => 'filsh\yii2\oauth2server\filters\auth\CompositeAuth',
        'except' => ['site/index', 'oauth2/rest/token','site/login','atraveo/index'],
        'authMethods' => [
            ['class' => 'yii\filters\auth\HttpBearerAuth'],
            ['class' => 'yii\filters\auth\QueryParamAuth', 'tokenParam' => 'accessToken'],
        ]
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['site/index', 'oauth2/rest/token','site/login','atraveo/index'],
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