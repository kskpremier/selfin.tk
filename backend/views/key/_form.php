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
/* @var $model reception\forms\KeeForm */
/* @var $form yii\widgets\ActiveForm */
//$model->pin = 123456;
//$model->e_key = md5(uniqid(rand(), true));
?>



<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'type')->widget(Select2::className(), [
        'data'=>['0'=>'Period','2'=>'Permanent'],
        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [],
    ])->label('E-Key type');?>

    <?= $form->field($model, 'startDate')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->startDate ,//date('M-d-Y, h:i'),
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
    $form->field($model, 'endDate')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->endDate ,//date('M-d-Y, h:i'),
        //'attribute' => 'from',
        //'options' => ['placeholder' => 'from what moment'],
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true,
        ]
    ]);?>
<!--    --><?//= $form->field($model, 'guest_id')->widget(Select2::className(), [
//        'data'=>($model->booking)?ArrayHelper::map($model->booking->guests,'id','contact_email'): ArrayHelper::map(Guest::find()->all(),'id','contact_email'),//['1'=>'svrybin','4'=>'domouprav'],
//        'value'=>0,
//        'options' => ['placeholder' => 'Select a guest ...'],
//        'pluginOptions' => [],
//    ])->label('for Guest');?>
<!--    --><?//= CheckboxX::widget([
//        'name'=>'booking_connection',
//        'options'=>['id'=>'booking_connection'],
//        'pluginOptions'=>['threeState'=>false],
//        'pluginEvents' =>[
//            "change"=>'function() { var checked;
//            if (!checked)
//                { $("select#key-booking_id").prop( "disabled", false );
//                    checked = true;}
//            else
//                { $("select#key-booking_id").prop( "disabled", true );
//                  checked = false;
//                 }
//            }'
//
//            // "reset"=>'function() { log("reset"); }',
//        ]
//    ]);
    ?>

    <?php

//    if ($model->bookingId)
//        echo  $form->field($model, 'bookingId')->textInput(['disabled'=>true])->label('for Booking #');
//    else echo $form->field($model, 'bookingId')->widget(Select2::className(), [
//        'data'=> ArrayHelper::map(\backend\models\Booking::find()->all() ,'id','id'),
//        'options' => ['placeholder' => 'Select a booking ...',
//            'disabled'=>true ],
//        'pluginOptions' => [],
//    ])->label('for Booking #');
    ?>
    <?php
//    if ($model->doorLockId)
        echo  $form->field($model, 'doorLockId')//->textInput(['disabled'=>true, 'value'=>$model->doorLock->lock_alias])->label('for Door lock #');

    ->widget(Select2::className(), [
            'data'=>ArrayHelper::map(\reception\entities\DoorLock\DoorLock::find()->all(),'id','lock_alias'),
            //'value'=>($model->type == '0')? 'Permanent':'Period',
            'options' => ['placeholder' => 'Select a type ...'],
            'pluginOptions' => [],
        ])->label('Door Lock');
?>
    <?php echo  $form->field($model, 'userId')//->textInput(['disabled'=>true, 'value'=>$model->doorLock->lock_alias])->label('for Door lock #');

    ->widget(Select2::className(), [
    'data'=>ArrayHelper::map(\reception\entities\User\User::find()->all(),'id','username'),
    //'value'=>($model->type == '0')? 'Permanent':'Period',
    'options' => ['placeholder' => 'Select a type ...'],
    'pluginOptions' => [],
    ])->label('For user');
    ?>
    <div class="form-group">
        <?= Html::submitButton('Create' , ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
