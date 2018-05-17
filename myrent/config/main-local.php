<?php

$config = [
//    'components' => [
//        'request' => [
//            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
//            'cookieValidationKey' => ''//'5vkxVrKZ7-VO6PkkIPff5T0y62jAIdta',
//        ],
//    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs'=> ['*'],
        'panels'=>[
            'queue'=>'\zhuravljov\yii\queue\debug\Panel',
        ],

    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

 return $config;
