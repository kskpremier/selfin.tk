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
    <div class="wrap">
        <?php
    NavBar::begin([
        'brandLabel' => 'mReception',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-collapse navbar-inverse collapse',
        ],
    ]);?>

    </div>

     <div>

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
]); ?>

        </div>


<!-- Content area -->
<div >

    <?= $content ?>

</div>
<!-- /content area -->


    <!-- /page container -->
    <?php $this->endBody() ?>
    </body>
    </html>

<?php $this->endPage() ?>