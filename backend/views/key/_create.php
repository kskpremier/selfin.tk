<?php

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

$this->title = 'Generating elecronical Key '. ($model->bookingId)? 'for booking #'.$model->bookingId :
                ($model->doorLockId)? 'for door lock '. ($model->getDoorLockName()):'';
$this->params['breadcrumbs'][] = ['label' => 'Key', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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

    <?php if ($model->bookingId) {
        echo $form->field($model, 'userId')->widget(Select2::className(), [
        'data'=>$model->guestList($model->bookingId),
        'value'=>0,
        'options' => ['placeholder' => 'Select a guest ...'],
        'pluginOptions' => [],
    ])->label('choosing Guest'); }
    else if ($model->doorLockId) {

        echo $form->field($model, 'userId')->widget(Select2::className(), [
        'data'=> $model->userList(),
        'options' => ['placeholder' => 'Select one user ...'
        ],
        'pluginOptions' => [],
        ])->label('choosing User');
    }
    else
    {
        echo $form->field($model, 'doorLockId')//->textInput(['disabled'=>true, 'value'=>$model->doorLock->lock_alias])->label('for Door lock #');

        ->widget(Select2::className(), [
            'data'=>ArrayHelper::map(DoorLockHelper::getDoorlocks(Yii::$app->getUser()->getId()),'id','lock_alias'),
            //'value'=>($model->type == '0')? 'Permanent':'Period',
            'options' => ['placeholder' => 'Select a door lock ...'],
            'pluginOptions' => [],
        ])->label('Door Lock');
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
