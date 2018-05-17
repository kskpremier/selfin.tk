<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'css/multifreezer.css',
        'css/site.css',

//        'css/core.css',
//        'css/myRent.css',
//        'css/semantic.css',
//        'css/components.css',
    ];
    public $js = [
//        'js/core/libraries/bootstrap.min.js',
//        'js/core/libraries/jasny_bootstrap.min.js',
//        'js/core/libraries/jquery.min.js',
//        'js/core/app.js',
//        'js/core/global.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',

        'yii\web\JqueryAsset',
//        'Zelenin\yii\SemanticUI\assets\SemanticUICSSAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
