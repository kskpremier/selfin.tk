<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoRealFace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-real-face-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'photo_image_id')->textInput() ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'album_id')->textInput() ?>

    <?= $form->field($model, 'x1')->textInput() ?>

    <?= $form->field($model, 'y2')->textInput() ?>

    <?= $form->field($model, 'x2')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
