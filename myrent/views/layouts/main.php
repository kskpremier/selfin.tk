<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/18/18
 * Time: 2:17 PM
 */
use myrent\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\helpers\Url;


AppAsset::register($this);

$this->beginPage() ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

        <!-- /theme JS files -->
        <?php $this->head() ?>
    </head>


    <body>
    <?php $this->beginBody() ?>
    <!-- Main navbar -->
    <div class="navbar navbar-collapse navbar-inverse collapse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html"><img src="/Images/logo.png" class="img-circle img-sm" alt=""></a>

        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">

                        </div>
                    </div>
                    <!-- /user menu -->


                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">



<?php
//main side-bar menu
$type= SideNav::TYPE_DEFAULT;
$item=[];
echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT ,
    'encodeLabels' => false,
    'heading' => '<div class="categoty-content">'.'<i class="glyphicon glyphicon-user"></i>  '. Yii::$app->user->identity->getUsername() .'</div>'  ,
    'containerOptions'=>['id'=>'','class'=>''],
    'items' => [
        ['label' => 'MyRent', 'icon' => 'myrent-icon', 'url' => Url::to(['/redirect/myrent', 'id'=>Yii::$app->user->getId()]), 'active' => ($item == 'home'),'options'=>['class'=>'faa-parent animated-hover']],
        ['label' => 'Receptions', 'icon' => 'glyphicon glyphicon-tower', 'options'=>['class'=>'faa-parent animated-hover'], 'items' => [
            ['label' => 'Kvarner',
                'url' => ['/rents/reception','reception'=>'Kvarner']],
            ['label' => 'Gajac',
                'url' => ['/rents/reception','reception'=>'Gajac']],
            ['label' => 'Savudrija',
                'url' => ['/rents/reception','reception'=>'Savudrija']],
            ['label' => 'Mareda',
                'url' => ['/rents/reception','reception'=>'Mareda']],
            ['label' => 'Cervar',
                'url' => ['/rents/reception','reception'=>'Cervar']],
            ['label' => 'Zaglav',
                'url' => ['/rents/reception','reception'=>'Zaglav']],
            ['label' => 'Barbariga',
                'url' => ['/rents/reception','reception'=>'Barbariga']],
        ]],
        ['label' => 'Door locks', 'icon' => 'glyphicon glyphicon-lock', 'options'=>['class'=>'faa-parent animated-hover'], 'url' => Url::to(['/superuser/door-lock', 'user'=>Yii::$app->user->getId()])],

        ['label' => 'Users', 'icon' => 'user', 'options'=>['class'=>'faa-parent animated-hover'] , 'url' => Url::to(['/superuser/users', 'user'=>Yii::$app->user->getId()])],
    ],
]);


                            ?>
                            <!-- /page kits -->


                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard Superuser</h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Manual</span></a>
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Support</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
                            <li class="active">Dashboard</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i>
                                    Settings
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <?= $content ?>

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>

    <!-- /page container -->
    <?php $this->endBody() ?>
    </body>
    </html>

<?php $this->endPage() ?>