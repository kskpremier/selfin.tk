<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model reception\entities\Feefo\FeefoProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feefo-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'object_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'log')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'params')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
