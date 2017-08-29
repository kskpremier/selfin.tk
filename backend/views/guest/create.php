<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Guest */

$this->title = Yii::t('app', 'Create Guest');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
