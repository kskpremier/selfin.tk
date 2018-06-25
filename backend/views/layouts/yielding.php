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
//            ['label' => 'Hosta', 'url' => ['/superuser/hosta'] , 'visible' => Yii::$app->user->can('hosta')],
            ['label' => 'Super', 'url' => ['/superuser/index'] , 'visible' => Yii::$app->user->can('superuser')],
            ['label' => 'Yielding', 'url' => ['/superuser/availability'] , 'visible' => Yii::$app->user->can('superuser')],
            ['label' => 'Filters', 'url' => ['/filters/index'] , 'visible' => Yii::$app->user->can('superuser')],
//            ['label' => 'Home', 'url' => ['/site/index']],

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

    <div class="container-fluid" style="margin-top: 60px;">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
