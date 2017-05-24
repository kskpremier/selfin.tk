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

?>


<div class="keyboard-pwd-form">

    <?php $form = ActiveForm::begin([
//        'action' => ['index'],
//        'method' => 'get',
    ]);; ?>


    <?= $form->field($model, 'keyboard_pwd_type')->widget(Select2::className(), [
        'data'=>['2'=>'Permanent','3'=>'Period','5'=>'Cycle','1'=>'One-time'],
        'value'=>($model->keyboard_pwd_type == 0)? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [],
    ])->label('Keyboard Password Type');?>

    <?= $form->field($model, 'start_day')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->start_day ,//date('M-d-Y, h:i'),

        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);
    ?>


    <?=
    $form->field($model, 'end_day')->widget(DateTimePicker::className(), [
        'value' => $model->end_day ,//date('M-d-Y, h:i'),
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);?>
    <?php  echo $form->field($model, 'keyboard_pwd_version')->textInput(['disabled'=>true]); ?>
    <?= $form->field($model, 'booking_id')->textInput(['disabled'=>true]) ?>
    <?= $form->field($model, 'door_lock_id')->textInput(['disabled'=>true]) ?>
    <?= $form->field($model, 'value')->textInput(['disabled'=>true,'value'=>$model->value]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
