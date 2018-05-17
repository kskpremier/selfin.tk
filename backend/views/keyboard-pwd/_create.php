<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 12:33
 */

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model reception\forms\KeyboardPwdForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Creating digital pass code for '. $model->getDoorLockName();//Yii::t('app', 'Create Keyboard Password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Keyboard Password'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/keyboardPwd.js');

?>

<div class="keyboard-pwd-form">

    <h1><?= Html::encode ($this->title);?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'keyboardPwd-form',
    ]); ?>

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
                        }"
            ),
        ],
    ])->label('Keyboard Password Type');?>
<div id="password-value" class="hidden">
    <?= $form->field($model, 'value')->textInput(['value'=>$model->value])->label('Value of Pin code'); ?>
</div>
    <div id="startDate" class="">
    <?= $form->field($model, 'startDate')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->startDate ,//date('M-d-Y, h:i'),

        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, HH P',
            'autoclose' => true,
//            "minuteStep" => 10,
            'minView'=> 1
        ]
    ]);
    ?>
    </div>
    </div>
    <div id="endDate" class="">
    <?=
    $form->field($model, 'endDate')->widget(DateTimePicker::className(), [
        'value' => $model->endDate ,//date('M-d-Y, h:i'),
        'type' => DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, HH P',
            'autoclose' => true,
//            "minuteStep" => 10,
            'minView'=> 1
        ]
    ]);?>
    </div>

    <?php
    if ($model->doorLockId)
        echo  $form->field($model, 'doorLockId')->hiddenInput(['disabled'=>true])->label(false);
    else echo $form->field($model, 'door_lock_id')->widget(Select2::className(), [
    'data'=> ArrayHelper::map(DoorLockHelper::getDoorlocks($user) ,'id','lock_alias'),
    'options' => ['placeholder' => 'Select a booking ...'],
    'pluginOptions' => [],
    ])->label('for DoorLock #'); ?>

    <?php
    if ($model->bookingId)
        echo  $form->field($model, 'bookingId')->textInput(['disabled'=>true])->label('for Booking #');
    else
        echo $form->field($model, 'bookingId')->widget(Select2::className(), [
            'data'=> $model->getAllBookings(),
            'options' => ['placeholder' => 'Select a booking ...'],
            'pluginOptions' => [],
        ])->label('for Booking #');
    ?>



    <div class="form-group">
        <?= Html::submitButton( 'Create' , ['btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
