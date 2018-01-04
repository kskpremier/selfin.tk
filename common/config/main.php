<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'queue',
//        'monitor',
    ],

    'aliases'=>[
        '@bower' =>'@vendor/bower-asset',
        '@npm'=>'@vendor/mpm-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
         //   'class' => 'yii\redis\Cache',
        ],
//        'authManager' => [
////            'class' => 'yii\rbac\PhpManager',
//            'class' => 'yii\rbac\DbManager',
//        ],


    //заменил как в shop
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_items}}',
            'itemChildTable' => '{{%auth_item_children}}',
            'assignmentTable' => '{{%auth_assignments}}',
            'ruleTable' => '{{%auth_rules}}',
            'defaultRoles' => ['tourist']
        ],
        'queue' => [
//            'class' => 'yii\queue\redis\Queue',
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis', // Redis connection component or its config
            'channel' => 'queue', // Queue channel key
            'as log' => 'yii\queue\LogBehavior',
//            'as monitor' => \zhuravljov\yii\queue\monitor\Behavior::class,
        ],

    ],
    'controllerNamespace' => 'common\controllers',

];
