<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

backend\assets\AppAsset::register($this);

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
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
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
        $menuItems = [

            ['label' => 'Super', 'url' => ['/superuser/index'] , 'visible' => Yii::$app->user->can('superuser')],
            ['label' => 'Yielding', 'url' => ['/superuser/availability'] , 'visible' => Yii::$app->user->can('superuser')],
            ['label' => 'Filters', 'url' => ['/filters/index'] , 'visible' => Yii::$app->user->can('superuser')],
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Feefo', 'url' => ['/feefo/index'] , 'visible' => Yii::$app->user->can('feefo')],
            ['label' => 'Apartments', 'url' => ['/apartment/index'],'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('mobile') and !Yii::$app->user->can('superuser')],
            ['label' => 'Bookings', 'url' => ['/booking/index'],'visible' => Yii::$app->user->can('admin') and !Yii::$app->user->can('superuser')],
            ['label' => 'Faces', 'url' => ['/photo-image/index'],'visible' => Yii::$app->user->can('admin') and !Yii::$app->user->can('superuser')],
            ['label' => 'Documents', 'url' => ['/document/index'],'visible' => Yii::$app->user->can('admin') and !Yii::$app->user->can('superuser')],
            ['label' => 'Photo', 'url' => ['/photo-document/index'],'visible' => Yii::$app->user->can('admin') and !Yii::$app->user->can('superuser')],
            ['label' => 'Owner', 'url' => ['/owner/index'],'visible' => Yii::$app->user->can('admin') and !Yii::$app->user->can('superuser')],
            ['label' => 'DoorLocks', 'url' => ['/door-lock/index'],'visible' => Yii::$app->user->can('admin')|| Yii::$app->user->can('mobile') and !Yii::$app->user->can('superuser')],
            ['label' => 'Keys', 'url' => ['/key/index'],
                'visible' => Yii::$app->user->can('superuser')||
                             Yii::$app->user->can('mobile') ||
                             Yii::$app->user->can('tourist') &&
                             !Yii::$app->user->can('vacation')
                             and !Yii::$app->user->can('superuser')],
            ['label' => 'Passwords', 'url' => ['/keyboard-pwd/index'],
                'visible' =>Yii::$app->user->can('superuser')||
                    Yii::$app->user->can('mobile') ||
                    Yii::$app->user->can('tourist') &&
                    !Yii::$app->user->can('vacation')
                    and !Yii::$app->user->can('superuser')],

            ['label' => 'Users', 'url' => ['/user/index'],'visible' => Yii::$app->user->can('admin') and !Yii::$app->user->can('superuser')],
//            ['label' => 'MyrentXML', 'url' => ['/vacation/index'],'visible' => Yii::$app->user->can('vacation')]
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
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; Domouprav --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
