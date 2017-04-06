<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // <?= $form->field($model, 'arrival_date')->textInput() ?>

    <?= $form->field($model, 'arrival_date')->widget(DatePicker::className(), [
        'model' => $model,
//        'value' => date(),
        'attribute' => 'arrival_date',
        'options' => ['placeholder' => 'Arrival date'],
        'type' => DatePicker::TYPE_INPUT ,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,]
    ]);
    ?>

    <?php // <?= $form->field($model, 'depature_date')->textInput() ?>

    <?= $form->field($model, 'depature_date')->widget(DatePicker::className(), [
        'model' => $model,
//        'value' => date(),
        'attribute' => 'depature_date',
        'options' => ['placeholder' => 'Departure date'],
        'type' => DatePicker::TYPE_INPUT ,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,]
    ]);
    ?>

    <?= $form->field($model, 'apartment_id')->textInput() ?>

    <?= $form->field($model, 'number_of_tourist')->textInput() ?>

    <?= $form->field($model, 'guest_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
