<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Camera;
use backend\models\Album;


/* @var $this yii\web\View */
/* @var $model backend\models\PhotoImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-image-form">
    <?php $model->date = date('Y-m-d H:i:s');
            $model->album_id = 1;
            $model-> camera_id = 1;
    ?>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'model' => $model,
//        'value' => date(),
        'attribute' => 'date',
        'options' => ['placeholder' => 'Creating date'],
        'type' => DatePicker::TYPE_INPUT ,
        'pluginOptions' => [
            'format' => 'Y-m-d H:i:s',
            'autoclose' => true,]
    ]); ?>

    <?= $form->field($model, 'camera_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Camera::find()->all(),'id','type'),
        //'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Enter type of camera ...'],
    ]); ?>

    <?= $form->field($model, 'booking_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\backend\models\Booking::find()->all(),'id','id'),
        //'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => ($model->booking_id)?$model->booking_id:'Enter reservation number ...'],
    ]); ?>

    <?= $form->field($model, 'album_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Album::find()->all(),'id','name'),
        //'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Enter name of album ...'],
    ]); ?>

    <?= $form->field($model, 'file_name')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
