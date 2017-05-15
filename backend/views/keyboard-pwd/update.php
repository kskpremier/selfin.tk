<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KeyboardPwd */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Keyboard Pwd',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Keyboard Pwds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="keyboard-pwd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
