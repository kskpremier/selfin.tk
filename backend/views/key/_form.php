<?php

use backend\helpers\DoorLockHelper;
use reception\helpers\UserHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use backend\models\Guest;

/* @var $this yii\web\View */
/* @var $model reception\forms\KeyForm*/
/* @var $form yii\widgets\ActiveForm */
//$model->pin = 123456;
//$model->e_key = md5(uniqid(rand(), true));
?>



<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'type')->widget(Select2::className(), [
        'data'=>[0=>'Period',2=>'Permanent',99=>'Admin'],
        'value'=>($model->type == 0)? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...','id'=>'type'],
        'pluginEvents' => [
            "change" => new JsExpression("function (params) {
                             var value = params.target.value;
                         
                            if (value != 99) {
                                 $('#startDate').removeClass('hidden');
                            }
                            if (value != 2) {
                                 $('#endDate').removeClass('hidden');
                            }
                            if (value == 0) {
                                  $('#endDate').removeClass('hidden');
                                  $('#startDate').removeClass('hidden');
                            }
                             
             }"),

            "select2:select" => new JsExpression("function(params) {
                           
                            var value = params.target.value;
                         
                            if (value == 99) {
                                   $('#endDate').addClass('hidden');
                                   $('#startDate').addClass('hidden');
                            }
                             if (value == 2) {
                                 $('#endDate').addClass('hidden');
                            }
                            if (value == 0) {
                                  $('#endDate').removeClass('hidden');
                                  $('#startDate').removeClass('hidden');
                            }
                        }"
            ),
        ],

    ])->label('E-Key type');?>
    <div id="startDate" class="">
    <?= $form->field($model, 'startDate')->widget(DateTimePicker::className(), [
        'value' => $model->startDate ,
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, HH P',
            'autoclose' => true,
            'minView'=> 1
        ]
    ]);
    ?>
    </div>
    <div id="endDate" class="">
    <?=
    $form->field($model, 'endDate')->widget(DateTimePicker::className(), [
        'value' => $model->endDate ,
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, HH P',
            'autoclose' => true,
            'minView'=> 1
        ]
    ]);
?>
    </div>
    <?php
//    if ($model->doorLockId)
        echo  $form->field($model, 'doorLockId')->widget(Select2::className(), [
            'data'=>ArrayHelper::map(DoorLockHelper::getDoorlocks(Yii::$app->getUser()->getId()),'id','lock_alias'),
            //'value'=>($model->type == '0')? 'Permanent':'Period',
            'options' => ['placeholder' => 'Select a door lock ...'],
            'pluginOptions' => [],
        ])->label('Door Lock');
?>
    <?php echo  $form->field($model, 'userId')//->textInput(['disabled'=>true, 'value'=>$model->doorLock->lock_alias])->label('for Door lock #');

    ->widget(Select2::className(), [
    'data'=>ArrayHelper::map(UserHelper::getConnectedUsers(Yii::$app->user->identity->getUserModel()),'id','username'),
    //'value'=>($model->type == '0')? 'Permanent':'Period',
    'options' => ['placeholder' => 'Select a user ...'],
    'pluginOptions' => [],
    ])->label('For user');
    ?>
    <div class="form-group">
        <?= Html::submitButton('Create' , ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
