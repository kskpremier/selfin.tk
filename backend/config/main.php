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

    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
        'api\bootstrap\SetUp',
        'monitor',
    ],
    'container' => [
        'singletons' => [
            \zhuravljov\yii\queue\monitor\Env::class => [
                'cache' => 'cache',
                'db' => 'db',
                'pushTableName' => '{{%queue_push}}',
                'execTableName' => '{{%queue_exec}}',
            ],
        ],
    ],
    'modules' => [
        'monitor' => [
            'class' => \zhuravljov\yii\queue\monitor\Module::class,
        ],
    ],
    'components' => [
        'queue' => [
////            'class' => 'yii\queue\redis\Queue',
//            'class' => \yii\queue\redis\Queue::class,
//            'redis' => 'redis', // Redis connection component or its config
//            'channel' => 'queue', // Queue channel key
//            'as log' => 'yii\queue\LogBehavior',*/
            'as monitor' => \zhuravljov\yii\queue\monitor\Behavior::class,
        ],

        'formatter' => [
            // 'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
//            'numberFormatterOptions' => [
//                NumberFormatter::MIN_FRACTION_DIGITS => 0,
//                NumberFormatter::MAX_FRACTION_DIGITS => 2,
//            ]
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

    'params' => $params,
];
