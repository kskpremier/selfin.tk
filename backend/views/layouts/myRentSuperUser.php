<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/18/18
 * Time: 2:17 PM
 */
use backend\assets\AppAssetMyRent;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\modules\Sidebar;

backend\assets\AppAssetMyRent::register($this);

//dmstr\web\AdminLteAsset::register($this);
//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

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
<div class="navbar navbar-inverse">
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


                            <?php NavBar ::begin([

                            'brandUrl' => Yii::$app->homeUrl,
                            'options' => [
                                'class' => 'navigation navigation-main navigation-accordion',
                                'style'=>'width 200px;'
                            ],
                            ]);
                            if (!Yii::$app->user->isGuest) {
                            $menuItems = [
                                    ['label' =>'Receptions',
                                        'labelTemplate' =>'{icon} Label',
                                    'items'=>[
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
                                        ]
                                ]
                            ];
                            }
                            if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => 'Login', 'url' => ['/auth/login']];
                            } else {
                            $menuItems[] = '<li>'
                                . Html::beginForm(['/auth/logout'], 'post')
                                . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->getUsername() . ')',
                                ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';
                            }
                            echo Nav::widget([
                            'options' => ['class' => 'nav nav-tabs nav-stacked','style'=>'width: 200px;'],
                            'items' => $menuItems,
                            ]);
                            NavBar::end();
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