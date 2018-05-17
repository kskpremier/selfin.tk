<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsPricesDaysSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-prices-days-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'day') ?>

    <?php // echo $form->field($model, 'check_in') ?>

    <?php // echo $form->field($model, 'check_out') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_b2b') ?>

    <?php // echo $form->field($model, 'price_special') ?>

    <?php // echo $form->field($model, 'min_stay') ?>

    <?php // echo $form->field($model, 'days_before') ?>

    <?php // echo $form->field($model, 'price_extra') ?>

    <?php // echo $form->field($model, 'price_extra_child') ?>

    <?php // echo $form->field($model, 'extra_from') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'changed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
