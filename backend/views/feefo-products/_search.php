<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model reception\entities\Feefo\FeefoProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feefo-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'log') ?>

    <?= $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'params') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
