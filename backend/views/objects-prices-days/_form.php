<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsPricesDays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-prices-days-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'object_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'day')->textInput() ?>

    <?= $form->field($model, 'check_in')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'check_out')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_b2b')->textInput() ?>

    <?= $form->field($model, 'price_special')->textInput() ?>

    <?= $form->field($model, 'min_stay')->textInput() ?>

    <?= $form->field($model, 'days_before')->textInput() ?>

    <?= $form->field($model, 'price_extra')->textInput() ?>

    <?= $form->field($model, 'price_extra_child')->textInput() ?>

    <?= $form->field($model, 'extra_from')->textInput() ?>

    <?= $form->field($model, 'enable')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'changed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
