<?php

use backend\helpers\DoorLockHelper;
use reception\forms\KeyboardPasswordForm;
use reception\forms\KeyboardPwdForm;
use reception\helpers\BookingHelper;
use reception\helpers\TTLHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model KeyboardPasswordForm */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="keyboard-pwd-form">

    <div class="keyboard-pwd-form">

        <h1><?= Html::encode ($this->title);?></h1>
        <?php $form = ActiveForm::begin([
            'id' => 'keyboardPwd-form',
        ]); ?>


        <div>
            <?php  if ($model->bookingId) {?>
                <?php echo  $form->field($model, 'bookingId')->hiddenInput(['disabled'=>true])->label(false);
            }

            ?>
        </div>
        <div><label class="cbx-label" for="check-box-my" id="for-bookinkg-label">Create for </label></div>

        <div id="checkbox-for-booking">
            <?php if (!$model->bookingId) echo kartik\checkbox\CheckboxX::widget([
                'name'=>'forBooking?',
                'options'=>['id'=>'booking'],
                'value'=>0,
                'pluginOptions'=>['threeState'=>false,
                    'size'=>'xl',
                    'iconUnchecked'=>'<i class="glyphicon glyphicon-calendar"></i>',
                    'iconChecked'=>'<i class="glyphicon glyphicon-globe"></i>',
                ],
                'pluginEvents' => [
                    "change" => new JsExpression("function (params) {
                             var value = params.target.value;
                            if (value == '1') {
                                 $('#booking-input').removeClass('hidden');
                                   $('#endDate').addClass('hidden');
                                  $('#startDate').addClass('hidden');
                                 $('#door_lock-input').addClass('hidden');
                                 $('#type-input').addClass('hidden');
                                 $('#for-bookinkg-label').text('Create for booking');
                               
                            }
                            if (value == '0') {
                                 $('#booking-input').addClass('hidden');
                                   $('#endDate').removeClass('hidden');
                                  $('#startDate').removeClass('hidden');
                                 $('#door_lock-input').removeClass('hidden');
                                  $('#type-input').removeClass('hidden');
                                  
                                   $('#for-bookinkg-label').text('Create for');
                            }
             }"),
                    "select2:select" => new JsExpression("function(params) {                         
                            var value = params.target.value;                       
                            if (value == '1') {
                                 $('#booking-input').removeClass('hidden');
                                   $('#endDate').addClass('hidden');
                                  $('#startDate').addClass('hidden');
                                 $('#door_lock-input').addClass('hidden');
                                 $('#type-input').addClass('hidden');
                            }
                            if (value == '0') {
                                 $('#booking-input').addClass('hidden');
                                   $('#endDate').removeClass('hidden');
                                  $('#startDate').removeClass('hidden');
                                 $('#door_lock-input').removeClass('hidden');
                                 $('#type-input').removeClass('hidden');
                            }
                        }"
                    ),
                ],
            ]);
            ?>
        </div>
        <div class="" id="booking-input">

            <?php
            echo $form->field($model, 'booking_internal_id')->widget(Select2::className(), [
                    'id'=>'check-box-my',
                'data'=> ArrayHelper::map(BookingHelper::getBookingsForUser($user),'id',function ($model){
                    return $model->external_id.'/ '.$model->apartment->name.'/ '.$model->start_date.'/ '.$model->end_date.'/ '.$model->author->contact_name
                        ;}),
                'options' => ['placeholder' => 'Select a booking ...'],
                'pluginOptions' => [

                ],
//                'pluginEvents' => [
//                    "change" => new JsExpression("function (params) {
//                            var value = params.target.value;
//
//                            if (value != '99') {
//                                 $('#password-value').addClass('hidden');
//                            }
//                            if (value != '2') {
//                                 $('#endDate').removeClass('hidden');
//                            }
//                            if (value != '1') {
//                                 $('#endDate').removeClass('hidden');
//                                  $('#startDate').removeClass('hidden');
//                            }
//
//             }"),
//                    "select2:select" => new JsExpression("function(params) {
//                            var value = params.target.value;
//                            if (value == '99') {
//                                 $('#password-value').removeClass('hidden');
//                            }
//                             if (value == '2') {
//                                 $('#endDate').addClass('hidden');
//                            }
//                            if (value == '1') {
//                                 $('#endDate').addClass('hidden');
//                                  $('#startDate').addClass('hidden');
//                            }
//                        }"
//                    ),
//                ],



            ]);
            ?>
        </div>
        <div id="door_lock-input">
            <?php
            if ($model->doorLockId)
                echo  $form->field($model, 'doorLockId')->hiddenInput(['disabled'=>true])->label(false);
            else echo $form->field($model, 'doorLockId')->widget(Select2::className(), [
                'data'=> ArrayHelper::map(DoorLockHelper::getDoorlocks($user) ,'id','lock_alias'),
                'options' => ['placeholder' => 'Select a door lock ...'],
                'pluginOptions' => [],
            ])->label('for DoorLock #');
            ?>
        </div>

        <div id="type-input">

        <?= $form->field($model, 'type')->widget(Select2::className(), [
            'data'=>$model->getKeyboardTypeList(),
            'options' => ['placeholder' => 'Select a type ...', 'id'=>'type'],
            'pluginEvents' => [
                "change" => new JsExpression("function (params) {
                             var value = params.target.value;
                         
                            if (value != '99') {
                                 $('#password-value').addClass('hidden');
                            }
                            if (value != '2') {
                                 $('#endDate').removeClass('hidden');
                            }
                            if (value != '1') {
                                 $('#endDate').removeClass('hidden');
                                  $('#startDate').removeClass('hidden');
                            }
                             if (value != '15') {
                                 $('#password-value').addClass('hidden');                              
                            }
//                             if (value != '13') {
//                                 $('#endDate').removeClass('hidden');
//                            }
                             
             }"),
                "select2:select" => new JsExpression("function(params) {                         
                            var value = params.target.value;                       
                            if (value == '99') {
                                 $('#password-value').removeClass('hidden');
                            }
                             if (value == '2') {
                                 $('#endDate').addClass('hidden');
                            }
                            if (value == '1') {
                                 $('#endDate').addClass('hidden');
                                  $('#startDate').addClass('hidden');
                            }
                             if (value == '15') {
                                 $('#password-value').removeClass('hidden');                              
                            }
                        }"
                ),
            ],
        ])->label('Keyboard Password Type');?>
        </div>

        <div id="password-value" class="hidden">
            <?= $form->field($model, 'value')->textInput(['value'=>$model->value])->label('Value of Pin code'); ?>
        </div>
        <div id="password-value-addType" class="hidden">
            <?= $form->field($model, 'addType')->hiddenInput(['value'=>TTLHelper::TTL_RECORD_VIA_GATEWAY])->label(false); ?>
        </div>
        <div id="startDate" class="">
            <?= $form->field($model, 'startDate')->widget(DateTimePicker::className(), [
                'value' => $model->startDate ,
                'type' => DateTimePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'format' => 'D, dd-M-yyyy, HH P',
                    'autoclose' => true,
                    'minView'=> 1
                ]
            ]);TTLHelper::TTL_RECORD_VIA_GATEWAY
            ?>
        </div>
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
        ]);?>
    </div>



    <div class="form-group">
        <?= Html::submitButton( 'Create' , ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
