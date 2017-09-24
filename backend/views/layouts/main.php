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
        'brandLabel' => 'Rona-rEception',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Apartments', 'url' => ['/apartment/index']],
            ['label' => 'Bookings', 'url' => ['/booking/index']],
            ['label' => 'Faces', 'url' => ['/photo-image/index']],
            ['label' => 'Documents', 'url' => ['/document/index']],
            ['label' => 'Photo', 'url' => ['/photo-document/index']],
            ['label' => 'Owner', 'url' => ['/owner/index']],
            ['label' => 'DoorLocks', 'url' => ['/door-lock/index']],
            ['label' => 'Keys', 'url' => ['/key/index']],
            ['label' => 'Passwords', 'url' => ['/keyboard-pwd/index']],
            ['label' => 'Users', 'url' => ['/user/index']],
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Domouprav <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
