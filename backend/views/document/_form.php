<?php

use reception\entities\Booking\Booking;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model reception\forms\GuestDocumentAddForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(['id' => 'GuestDocumentAddForm',
        //'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model->eVisitorForm, 'firstName')->textInput(['maxlength' => true])->label('First name'); ?>
    <?= $form->field($model->eVisitorForm, 'secondName')->textInput(['maxlength' => true])->label('Last Name'); ?>
    <?= $form->field($model->eVisitorForm, 'numberOfDocument')->textInput(['maxlength' => true])->label('Number of document'); ?>
    <?= $form->field($model->eVisitorForm, 'address')->textInput()->label('Address (street..)' ); ?>
    <?= $form->field($model->eVisitorForm, 'city')->textInput(['maxlength' => true])->label('City'); ?>
    <?= $form->field($model->eVisitorForm, 'cityOfBirth')->textInput(['maxlength' => true])->label('City address of birth'); ?>

    <?= $form->field($model->eVisitorForm, 'countryOfBirth')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(\backend\models\Country::find()->all(),'code','name'),
        'attribute' => 'countryOfBirth',
        'options' => ['placeholder' => 'Select a country of birth'],
        'pluginOptions' => [],
    ])->label('Country Of Birth');?>
    <?php echo '<label class="control-label">Citizenship</label>'; ?>
    <?= Select2::widget([
        'model'=>$model->eVisitorForm,
        'data'=> ArrayHelper::map(\backend\models\Country::find()->all(),'code','name'),
        'attribute' => 'country',
        'options' => ['placeholder' => 'Select a citizenship'],
        'pluginOptions' => [],
    ]);?>
    <?php echo '<label class="control-label">Type of ID</label>'; ?>
    <?= Select2::widget([
            'model'=>$model->eVisitorForm,
        'data'=> ArrayHelper::map(\backend\models\DocumentType::find()->all(),'code','name'),
        'attribute' => 'identityData',
        'options' => ['placeholder' => 'Select a type of ID'],
        'pluginOptions' => [],
    ]); ?>
    <?php echo '<label class="control-label">Booking ID</label>'; ?>
    <?= Select2::widget([
        'model'=>$model->eVisitorForm,
        'data'=> ArrayHelper::map(Booking::find()->all(),'id','external_id'),
        'attribute' => 'bookingId',
        'options' => ['placeholder' => 'Select booking'],
        'pluginOptions' => [],
    ]); ?>

    <?= $form->field($model->eVisitorForm, 'dateOfBirth')->widget(DatePicker::className(), [
        'model' => $model,
        //'attribute' => $model->eVisitorForm->dateOfBirth,
        'options' => ['placeholder' => 'Date of Birth'],
        'type' => DatePicker::TYPE_INPUT ,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,]
    ])->label('Date Of Birth'); ?>
    <?= $form->field($model->eVisitorForm, 'validBefore')->widget(DatePicker::className(), [
        'model' => $model,
        //'attribute' => $model->eVisitorForm->validBefore,
        'options' => ['placeholder' => 'Expired date'],
        'type' => DatePicker::TYPE_INPUT ,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,]
    ])->label('Document expired'); ?>


    <?= $form->field($model->PhotosForm, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label("Document image"); ?>

    <?= $form->field($model->SelfyForm, 'files')->fileInput(['accept' => 'image/*'])->label("Selfy image") ?>



    <div class="form-group">
        <?= Html::submitButton( Yii::t('app', 'Create') , ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
