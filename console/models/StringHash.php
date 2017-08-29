<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.04.17
 * Time: 20:35
 */
namespace console\models;

//use Yii;

$password = "masha";
$hash = Yii::$app->getSecurity()->generatePasswordHash($password);
echo $hash;