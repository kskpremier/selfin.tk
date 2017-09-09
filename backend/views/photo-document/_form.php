<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Document;
use backend\models\Album;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocument */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-document-form">
    <?php $model->date = date('Y-m-d');
    $model->album_id = 3;
//    $model->application_id = 3;
    ?>

    <?php $form = ActiveForm::begin(['enableClientValidation' => false,'options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'model' => $model,
//        'value' => date(),
        'attribute' => 'date',
        'options' => ['placeholder' => 'Creating date'],
        'type' => DatePicker::TYPE_INPUT ,
        'pluginOptions' => [
            'format' => 'Y-m-d',
            'autoclose' => true,]
    ]);
    ?>



    <?= $form->field($model, 'file_name')->fileInput() ?>
    <?= $form->field($model, 'document_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Document::find()->all(),'id','second_name'),
        //'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Enter number of document ...'],
    ]); ?>
    <?= $form->field($model, 'album_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Album::find()->all(),'id','name'),
        //'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Enter name of album ...'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
