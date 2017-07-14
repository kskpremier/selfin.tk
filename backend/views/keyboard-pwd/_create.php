<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 12:33
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model reception\forms\KeyboardPwdForm */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="keyboard-pwd-form">

    <?php $form = ActiveForm::begin([]);; ?>

    <?= $form->field($model, 'type')->widget(Select2::className(), [
        'data'=>$model->getKeyboardTypeList(),
        //'value'=>($model->keyboardPwdType == 0) ? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [],
    ])->label('Keyboard Password Type');?>

    <?= $form->field($model, 'startDate')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->startDate ,//date('M-d-Y, h:i'),

        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);
    ?>


    <?=
    $form->field($model, 'endDate')->widget(DateTimePicker::className(), [
        'value' => $model->endDate ,//date('M-d-Y, h:i'),
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);?>


    <?php
    if ($model->bookingId)
        echo  $form->field($model, 'bookingId')->textInput(['disabled'=>true])->label('for Booking #');
    else echo $form->field($model, 'bookingId')->widget(Select2::className(), [
        'data'=> $model->getBookingList($model->bookingId),
        'options' => ['placeholder' => 'Select a booking ...'],
        'pluginOptions' => [],
    ])->label('for Booking #');
    ?>
    <?php
    if ($model->doorLockId)
        echo  $form->field($model, 'doorLockId')->textInput(['disabled'=>true])->label('for Door lock #'); ?>

    <?php  //по умолчанию , пока непонятно что в документации у китайцев

    echo $form->field($model, 'keyboardPwdVersion')->hiddenInput(); ?>


    <div class="form-group">
        <?= Html::submitButton( 'Create' , ['btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
