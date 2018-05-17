<?php

use backend\helpers\DoorLockHelper;
use reception\helpers\BookingHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use backend\models\Guest;

/* @var $this yii\web\View */
/* @var $model reception\forms\KeyForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Generating elecronical Key ';
 if ($model->bookingId) $this->title .= ' for booking #'.$model->bookingId;
 if ($model->doorLockId) $this->title .= ' for door lock '. ($model->getDoorLockName());
$this->params['breadcrumbs'][] = ['label' => 'Key', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="key-form">

    <h1> <?=Html::encode($this->title)?></h1>

    <?php $form = ActiveForm::begin(); ?>

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



            ]);?>

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
    if ($model->bookingId) { ?>
        <div id="booking-select" class="">
            <?php
        echo $form->field($model, 'userId')->widget(Select2::className(), [
            'data'=>$model->guestList($model->bookingId),
            'value'=>0,
            'options' => ['placeholder' => 'Select a guest ...'],
            'pluginOptions' => [],
        ])->label('choosing Guest');
            $model->role = ['lock','tourist'];

        ?>
        </div>
    <?php }
    elseif ($model->doorLockId)
    { ?>
        <div id="user-info" class="">
        <?php echo $form->field($model, 'username')->textInput() ;
        echo $form->field($model, 'password')->passwordInput(['maxLength' => true]) ;
        echo $form->field($model, 'email')->textInput() ;
        echo $form->field($model, 'role')->hiddenInput(['value'=>'lock'])->label(false) ;
        $model->role = 'lock'; ?>
    </div>
        <?php
    }
    else  { ?>
        <div id="door-lock" class="">
       <?php  echo  $form->field($model, 'doorLockId')->widget(Select2::className(), [
            'data'=>ArrayHelper::map(DoorLockHelper::getDoorlocks(Yii::$app->getUser()->getId()),'id','lock_alias'),
            //'value'=>($model->type == '0')? 'Permanent':'Period',
            'options' => ['placeholder' => 'Select a door lock ...'],
            'pluginOptions' => [],
        ])->label('Door Lock'); ?>
        </div>

        <div id="user-info" class="">
<?php        echo $form->field($model, 'username')->textInput() ;
        echo $form->field($model, 'password')->passwordInput(['maxLength' => true]) ;
        echo $form->field($model, 'email')->textInput() ;
        echo $form->field($model, 'role')->hiddenInput(['value'=>'lock'])->label(false) ;
        $model->role = 'lock';

    }
    ?>
        </div>
    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>