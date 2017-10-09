<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


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


    <?= $form->field($model, 'booking_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\backend\models\Booking::find()->all(),'id','id'),
        //'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => ($model->booking_id)?$model->booking_id:'Enter reservation number ...'],
    ]); ?>

    <?= $form->field($model->PhotosForm, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' =>  'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
