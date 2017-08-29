<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocumentFaceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-document-face-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'photo_document_id') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'album_id') ?>

    <?php // echo $form->field($model, 'x1') ?>

    <?php // echo $form->field($model, 'y2') ?>

    <?php // echo $form->field($model, 'x2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
