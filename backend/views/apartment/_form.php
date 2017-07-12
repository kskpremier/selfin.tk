<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Apartment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apartment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'location')->widget(Select2::className(), [
        'data'=> ["Kvarner"=>"Kvarner","Cervar"=>"Cervar","Barbariga"=>"Barbariga","Other"=>"Other"],
//        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select reception desk ...'],
        'pluginOptions' => [],
    ])->label('Location') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Apartment name'); ?>

    <?= $form->field($model, 'external_id')->textInput(['maxlength' => true])->label('Identity in MyRent or Mars system'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
