
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use yii\widgets\ActiveForm;

$this->title = 'Calculation price of Subscription';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="calculator-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box-header with-border">Object data</div>
    <div class="box-body">
    <?= $form->field($model, 'square')->textInput() ->label('Square of living part apartment, in M2')?>
    <?= $form->field($model, 'square_balcon')->textInput() ->label('Square of balcon apartment, in M2')?>
    <?= $form->field($model, 'volumeOfBooking')->textInput()->label('Volume of booking, annually EUR') ?>
    <?= $form->field($model, 'beds')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'numberSingleBed')->textInput()->label("Single beds number") ?>
    <?= $form->field($model, 'numberDoubleBed')->textInput()->label("Double beds number") ?>
    <?= $form->field($model, 'numberKidsBed')->textInput()->label("Kids beds number")?>
    <?= $form->field($model, 'price')->textInput()->label('Price per day, in Eur') ?>
    <?= $form->field($model, 'numberOfCheckin')->textInput()->label('Average number of checkins (smenas) ') ?>
    <?= $form->field($model, 'durationOfStaying')->textInput()->label('Average days of staying (duration of smenas) ') ?>
    </div>


    <div class="box-header with-border">Services</div>
    <div class="box-body">
    <?= $form->field($model, 'multichannel')->checkbox() ?>
    <?= $form->field($model, 'yielding')->checkbox() ?>
    <?= $form->field($model, 'reception')->checkbox() ?>
    <?= $form->field($model, 'houseKeeping')->checkbox() ?>
    <?= $form->field($model, 'linen')->checkbox() ?>
    <?= $form->field($model, 'handyMan')->checkbox() ?>
    </div>




    <div class="form-group">
        <?= Html::submitButton( 'Calculate', ['btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
