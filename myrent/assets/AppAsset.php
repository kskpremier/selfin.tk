<?php

namespace myrent\assets;

use yii\helpers\Url;
use yii\web\AssetBundle;
use Yii;

/**
 * Myrent backend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';//'/Users/superbrodyaga/Sites/public_html/backend/myRent/LTR/default/assets';
    public $baseUrl = '@web';//'http://backend.domouprav.local/myRent/LTR/default';

//css
    public $css = [
        'css/site.css',
        'css/custom-menu.css',
        'css/semantic.css',
        'css/superuser.css',
        'extras/animate.min.css',
//        "css/components.css",
        "css/icons/icomoon/styles.css",
        "css/bootstrap.css",
        "css/core.css",
        "css/colors.css",

        'css/myrent.css',


        ];
    public $js = [
//        "js/core/libraries/jquery.min.js",
//        "js/plugins/loaders/pace.min.js",
//        "js/core/libraries/bootstrap.min.js",
//        "js/plugins/loaders/blockui.min.js",
//        "js/plugins/visualization/d3/d3.min.js",
//        "js/plugins/visualization/d3/d3_tooltip.js",
//        "js/plugins/forms/styling/switchery.min.js",
//        "js/plugins/forms/styling/uniform.min.js",
//        "js/plugins/forms/selects/bootstrap_multiselect.js",
//        "js/plugins/ui/moment/moment.min.js",
//        "js/plugins/pickers/daterangepicker.js",
//        "js/pages/dashboard.js",
//        "js/core/app.js",
//        "js/core/global.js",
//        "js/core/base.js",
//        "js/plugins/pickers/daterangepicker_nev.js"

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\web\JqueryAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}