<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases'=>[
        '@bower' =>'@vendor/bower-asset',
        '@npm'=>'@vendor/mpm-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],

    ],
    'controllerNamespace' => 'common\controllers',

];
