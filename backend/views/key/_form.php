<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Key */
/* @var $form yii\widgets\ActiveForm */
$model->pin = 123456;
$model->e_key = md5(uniqid(rand(), true));
?>



<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'type')->widget(Select2::className(), [
        'data'=>['0'=>'Permanent','2'=>'Period'],
        'value'=>($model->type == 0)? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [],
    ])->label('E-Key type');?>

    <?= $form->field($model, 'from')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->from ,//date('M-d-Y, h:i'),
        //'attribute' => 'from',
        //'options' => ['placeholder' => 'from what moment'],
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);
    ?>


    <?=// $form->field($model, 'till')->textInput()
    $form->field($model, 'till')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->till ,//date('M-d-Y, h:i'),
        //'attribute' => 'from',
        //'options' => ['placeholder' => 'from what moment'],
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);?>


    <?= $form->field($model, 'booking_id')->textInput(['disabled'=>true]) ?>
    <?= $form->field($model, 'door_lock_id')->textInput(['disabled'=>true]) ?>

    <?= $form->field($model, 'pin')->textInput(['disabled'=>true,'value'=>$model->pin]) ?>

    <?= $form->field($model, 'e_key')->textInput(['maxlength' => true, 'disabled'=>true,'value'=>$model->e_key]) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
