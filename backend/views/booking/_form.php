<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // <?= $form->field($model, 'arrival_date')->textInput() ?>

    <?= $form->field($model, 'apartment_id')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(\backend\models\Apartment::find()->all(),'id','name'),
//        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select an apartment ...'],
        'pluginOptions' => [],
    ])->label('Apartment');?>


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
    <?= $form->field($model, 'first_name')->textInput() ->label('Guest name')?>
    <?= $form->field($model, 'second_name')->textInput()->label('Guest second name') ?>
    <?= $form->field($model, 'contact_email')->textInput()->label('Guest email') ?>

    <?= $form->field($model, 'number_of_tourist')->textInput() ?>

    <?= $form->field($model, 'guest_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'external_id')->textInput()->label('Booking #'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
