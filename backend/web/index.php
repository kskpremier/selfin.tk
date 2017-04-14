<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// регистрация загрузчика классов Composer
require(__DIR__ . '/../../vendor/autoload.php');
// подключение файла класса Yii (установка автозагрузчика классов Yii)
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

// загрузка конфигурации приложения
$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

// создание и конфигурация приложения, а также вызов метода для обработки входящего запроса
(new yii\web\Application($config))->run();
