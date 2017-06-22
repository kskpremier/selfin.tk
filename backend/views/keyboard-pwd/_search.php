<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KeyboardPwdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keyboard-pwd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'start_date') ?>

    <?= $form->field($model, 'end_date') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'keyboard_pwd_type') ?>

    <?php // echo $form->field($model, 'keyboard_pwd_version') ?>

    <?php // echo $form->field($model, 'door_lock_id') ?>

    <?php // echo $form->field($model, 'booking_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
