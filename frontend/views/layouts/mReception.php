<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\LanguageSwitcherWidget;
use cinghie\multilanguage\widgets\MultiLanguageWidget;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\helpers\Url;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->
    <!--    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200i,300,400,700">-->

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,800&amp;subset=latin-ext" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<?php $this->beginBody() ?>
<body>
<div class="container">

    <?php Modal::begin([
        'header' => '<h1>'. Yii::t('mReception',  'Cookies information').'</h1>',
        'options' =>['id'=>'modal-cookies'],
        'footer' => 'hosta.hr',
        'size' => 'modal-lg',
        'headerOptions'=>['class'=>'modal-hosta text-center'],
        'bodyOptions'=>['class'=>'modal-hosta'],
    ]); ?>

    <div class="cookies-modal">
        <div class="row">
            <?php
            echo $this->render("/site/static/cookies_en.php");
            ?>
        </div>
    </div>
    <?php Modal::end(); ?>


    <?php Modal::begin([
        'header' => '<h1>'. Yii::t('mReception',  'Legal notice').'</h1>',
        'options' =>['id'=>'modal-legal-notice'],
        'footer' => 'hosta.hr',
        'size' => 'modal-lg',
        'headerOptions'=>['class'=>'modal-hosta text-center'],
        'bodyOptions'=>['class'=>'modal-hosta'],
    ]); ?>
    <div class="modal-legal-notice">
        <div class="row">
            <?php echo $this->render("/site/static/legal_notice_en.php")?>
        </div>
    </div>
    <?php Modal::end(); ?>


    <?php Modal::begin([
        'header' => '<h1>'. Yii::t('mReception',  'Terms and conditions').'</h1>',
        'options' =>['id'=>'modal-terms'],
        'footer' => 'hosta.hr',
        'size' => 'modal-lg',
        'headerOptions'=>['class'=>'modal-hosta text-center'],
        'bodyOptions'=>['class'=>'modal-hosta'],
    ]); ?>
    <div class="modal-terms-and-conditions">
        <div class="row">
            <?php echo $this->render("/site/static/terms&condition_en.php")?>
        </div>
    </div>
    <?php Modal::end(); ?>


</div>


<div class="container" style="height: 1px; letter-spacing: 0.01em;">
    <div  style="position: relative; top: 5px; right: -10px;">
        <div class="col-md-8">
        </div>
        <div class="col-lg-4 col-md-4  col-xs-12 text-right" style="padding: 0; ">
            <div class="col-lg-2  col-md-2 col-xs-2" style="padding-top: 5px;">
                <?= MultiLanguageWidget::widget([
                    'widget_type' => 'selector', // classic or selector
                    'image_type'  => 'classic', // classic or rounded
                    'width'       => '18',
                    'calling_controller' => $this->context
                ]); ?>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 text-right">
                <h5><small><a href="mailto:info@domouprav.hr?Subject=mReception%20" target="_top"><?= Html::encode(Yii::t('mReception',  'info@domouprav.hr'))?></a></small></h5>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-5 text-right">
                <h5><small><a href="callto:+385997056050">+385 ‎99 705 60 50</a></small></h5>
            </div>
            <div class="col-lg-1 col-md-1 col-xs-1" style=" margin-top: 10px; margin-left: -10px; " >
                <?= Html::img(Url::to("@web/css/images/hosta/1x/facebook-icon.png"),['id' => 'facebook', "height"=>"15px", "class"=>"center-block"]) ?>
            </div>
        </div>
    </div>
</div>



<div class="wrap">


    <?php
    NavBar::begin([
        'brandLabel' =>  Html::a (Html::img(Url::to("@web/css/images/logo.png"),['id' => 'logo', "height"=>"60px"]),Yii::$app->homeUrl) ,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar  navbar-default navbar-top',  'style'=>'margin-top: 30px; background-color: rgba(0,0,0,0);  border: none;'
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-right hosta-menu'],

        'items' => [
           
            ['label' => Yii::t('mReception',  'CheckIn'), 'url' => ['/site/checkin'],'linkOptions'=>[]],
            ['label' => Yii::t('mReception',  'Door Locks'), 'url' => ['/site/locks'],'linkOptions'=>['style'=>'color: #223F80;']],
            ['label' => Yii::t('mReception',  'Facial recognition'), 'url' => ['/site/face'],'linkOptions'=>[]],
            ['label' => Yii::t('mReception',  'Prices'), 'url' => ['/site/prices'],'linkOptions'=>[]],
            ['label' => Yii::t('mReception',  'FAQ'), 'url' => ['/site/questions'],'linkOptions'=>[]],
        ],
    ]);
    NavBar::end();?>

    <div class="container" style="padding-top: 0px;">
        <?= \yii\bootstrap\Alert::widget() ?>
        <?= $content ?>
    </div>

    <footer class="footer" style="font-family: 'Nunito', sans-serif; padding-top: 5px;">
        <!-- Cookies info etc section -->
        <div class="container text-center" style="background-color: #FFFFFF; ">

            <div class="" style="margin-left: auto; margin-right: auto; display: block; width: 60%">
                <div class="col-md-3 col-sm-3"><h5 class="text-dark-gray" style="margin-top: 30px; margin-bottom: 30px;">
                        <?= Html::a(Yii::t('mReception',  'Cookies information'),['#'],
//                        [Url::to( "@web/docs/COOKIES.pdf")],['class'=>"text-dark-gray",
                            ['data-toggle'=>'modal', 'data-target'=>'#modal-cookies', 'style'=>'color: #231F20']
                        )?></h5> </div>
                <div class="col-md-1 col-sm-1"><h5 class="text-dark-gray" style="margin-top: 30px; margin-bottom: 30px;">|</h5></div>
                <div class="col-md-3 col-sm-3"><h5 class="text-dark-gray" style="margin-top: 30px; margin-bottom: 30px;">
                        <?= Html::a(Yii::t('mReception',  'Legal notice'),['#'],['class'=>"text-dark-gray",'data-toggle'=>'modal', 'data-target'=>'#modal-legal-notice','style'=>'color: #231F20'] )?></h5> </div>
                <div class="col-md-1 col-sm-1"><h5 class="text-dark-gray" style="margin-top: 30px; margin-bottom: 30px;">|</h5></div>
                <div class="col-md-3 col-sm-3"> <h5 class="text-dark-gray" style="margin-top: 30px; margin-bottom: 30px;">
                        <?= Html::a(Yii::t('mReception',  'Terms and conditions'),['#'], ['class'=>"text-dark-gray",'data-toggle'=>'modal', 'data-target'=>'#modal-terms','style'=>'color: #231F20'] )?></h5></div>
            </div>

        </div>
        <div class="container text-center">
            <div class="row">
                <p> © <?= date('Y') ?> by SelfIn. All rights reserved | mReception is a part of the MyRent team. </p>
            </div>
    </footer>
</div>

</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
