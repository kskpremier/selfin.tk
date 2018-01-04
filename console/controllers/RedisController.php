<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RedisController extends Controller
{
    public function actionTest(): void
    {
        $data =1234;
     Yii::$app->redis->set('mykey', $data);
     echo Yii::$app->redis->get('mykey');
     echo PHP_EOL;
    }
}