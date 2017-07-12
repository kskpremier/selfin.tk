<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use backend\models\Guest;

/* @var $this yii\web\View */
/* @var $model backend\models\Key */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Editing data elecronical Key '. ($model->bookingId)? 'for booking #'.$model->bookingId :
    ($model->doorLockId)? 'for door lock '. ($model->getDoorLockName()):'';
$this->params['breadcrumbs'][] = ['label' => 'Key', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->widget(Select2::className(), [
        'data'=>['0'=>'Period','2'=>'Permanent'],
        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [],
    ])->label('Key type');?>

    <?= $form->field($model, 'startDate')->widget(DateTimePicker::className(), [
        //'model' => $model,
        'value' => $model->startDate,//date('M-d-Y, h:i'),
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
    ?>

    <div class="form-group">
        <?= Html::submitButton('Create ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
