<?php

namespace backend\assets;

use yii\helpers\Url;
use yii\web\AssetBundle;
use Yii;

/**
 * Myrent backend application asset bundle.
 */
class AppAssetMyRent extends AssetBundle
{

    public $basePath = '@webroot';//'/Users/superbrodyaga/Sites/public_html/backend/myRent/LTR/default/assets';
    public $baseUrl = '@web';//'http://backend.domouprav.local/myRent/LTR/default';

//myRent/LTR/default/assets/css

    public $css = [
        'css/semantic.css',
        "myRent/LTR/default/assets/css/components.css",
//        'css/myRent.css',
//        'css/semantic.css',
"myRent/LTR/default/assets/css/icons/icomoon/styles.css",
"myRent/LTR/default/assets/css/bootstrap.css",
"myRent/LTR/default/assets/css/core.css",

"myRent/LTR/default/assets/css/colors.css",

        'css/myRent.css',

    ];
    public $js = [
        "myRent/LTR/default/assets/js/core/libraries/jquery.min.js",
   "myRent/LTR/default/assets/js/plugins/loaders/pace.min.js",

   "myRent/LTR/default/assets/js/core/libraries/bootstrap.min.js",
   "myRent/LTR/default/assets/js/plugins/loaders/blockui.min.js",


//    "myRent/LTR/default/assets/js/plugins/loaders/pace.min.js",
//    "myRent/LTR/default/assets/js/core/libraries/jquery.min.js",
//    "myRent/LTR/default/assets/js/core/libraries/bootstrap.min.js",
//    "myRent/LTR/default/assets/js/plugins/loaders/blockui.min.js",
    "myRent/LTR/default/assets/js/plugins/visualization/d3/d3.min.js",
    "myRent/LTR/default/assets/js/plugins/visualization/d3/d3_tooltip.js",
    "myRent/LTR/default/assets/js/plugins/forms/styling/switchery.min.js",
    "myRent/LTR/default/assets/js/plugins/forms/styling/uniform.min.js",
    "myRent/LTR/default/assets/js/plugins/forms/selects/bootstrap_multiselect.js",
    "myRent/LTR/default/assets/js/plugins/ui/moment/moment.min.js",
    "myRent/LTR/default/assets/js/plugins/pickers/daterangepicker.js",

    "myRent/LTR/default/assets/js/pages/dashboard.js",
        "myRent/LTR/default/assets/js/core/app.js",
        "myRent/LTR/default/assets/js/pages/global.js",
        "myRent/LTR/default/assets/js/pages/base.js",
//<script type="text/javascript" src="/assets/js/plugins/pickers/daterangepicker_nev.js">
//</script>
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\web\JqueryAsset',
//        'Zelenin\yii\SemanticUI\assets\SemanticUICSSAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}