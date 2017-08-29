<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use backend\models\Guest;

/* @var $this yii\web\View */
/* @var $model backend\models\Key */
/* @var $form yii\widgets\ActiveForm */
$model->pin = 123456;
$model->e_key = md5(uniqid(rand(), true));
?>



<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'type')->widget(Select2::className(), [
        'data'=>['0'=>'Period','2'=>'Permanent'],
        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [],
    ])->label('E-Key type');?>

    <?= $form->field($model, 'start_date')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->start_date ,//date('M-d-Y, h:i'),
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
    $form->field($model, 'end_date')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->end_date ,//date('M-d-Y, h:i'),
        //'attribute' => 'from',
        //'options' => ['placeholder' => 'from what moment'],
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);?>
    <?= $form->field($model, 'guest_id')->widget(Select2::className(), [
        'data'=>($model->booking)?ArrayHelper::map($model->booking->guests,'id','contact_email'): ArrayHelper::map(Guest::find()->all(),'id','contact_email'),//['1'=>'svrybin','4'=>'domouprav'],
        'value'=>0,
        'options' => ['placeholder' => 'Select a guest ...'],
        'pluginOptions' => [],
    ])->label('for Guest');?>
    <?= CheckboxX::widget([
        'name'=>'booking_connection',
        'options'=>['id'=>'booking_connection'],
        'pluginOptions'=>['threeState'=>false],
        'pluginEvents' =>[
            "change"=>'function() { var checked;
            if (!checked)
                { $("select#key-booking_id").prop( "disabled", false );
                    checked = true;} 
            else
                { $("select#key-booking_id").prop( "disabled", true );
                  checked = false;
                 }
            }'

            // "reset"=>'function() { log("reset"); }',
        ]
    ]);
    ?>

    <?php

    if ($model->booking_id)
        echo  $form->field($model, 'booking_id')->textInput(['disabled'=>true])->label('for Booking #');
    else echo $form->field($model, 'booking_id')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(\backend\models\Booking::find()->all() ,'id','id'),
        'options' => ['placeholder' => 'Select a booking ...',
            'disabled'=>true ],
        'pluginOptions' => [],
    ])->label('for Booking #');
    ?>
    <?php
    if ($model->door_lock_id)
        echo  $form->field($model, 'door_lock_id')->textInput(['disabled'=>true, 'value'=>$model->doorLock->lock_name])->label('for Door lock #'); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
