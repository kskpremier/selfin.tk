<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsFacilitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-facilities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'seaview') ?>

    <?= $form->field($model, 'babycot') ?>

    <?php // echo $form->field($model, 'breakfast') ?>

    <?php // echo $form->field($model, 'halfboard') ?>

    <?php // echo $form->field($model, 'fullboard') ?>

    <?php // echo $form->field($model, 'berth') ?>

    <?php // echo $form->field($model, 'jacuzzi') ?>

    <?php // echo $form->field($model, 'terrace') ?>

    <?php // echo $form->field($model, 'tv_satelite') ?>

    <?php // echo $form->field($model, 'wifi') ?>

    <?php // echo $form->field($model, 'internet_fast') ?>

    <?php // echo $form->field($model, 'internet') ?>

    <?php // echo $form->field($model, 'smoking') ?>

    <?php // echo $form->field($model, 'luxurious') ?>

    <?php // echo $form->field($model, 'air_conditioning') ?>

    <?php // echo $form->field($model, 'tv_lcd') ?>

    <?php // echo $form->field($model, 'wheelchair_accessible') ?>

    <?php // echo $form->field($model, 'near_beach') ?>

    <?php // echo $form->field($model, 'pets') ?>

    <?php // echo $form->field($model, 'near_country') ?>

    <?php // echo $form->field($model, 'near_city') ?>

    <?php // echo $form->field($model, 'in_city') ?>

    <?php // echo $form->field($model, 'in_country') ?>

    <?php // echo $form->field($model, 'swimming_pool') ?>

    <?php // echo $form->field($model, 'swimming_pool_indoor') ?>

    <?php // echo $form->field($model, 'swimming_pool_indoor_heated') ?>

    <?php // echo $form->field($model, 'swimming_pool_outdoor') ?>

    <?php // echo $form->field($model, 'swimming_pool_outdoor_heated') ?>

    <?php // echo $form->field($model, 'parking') ?>

    <?php // echo $form->field($model, 'sauna') ?>

    <?php // echo $form->field($model, 'gym') ?>

    <?php // echo $form->field($model, 'separate_kitchen') ?>

    <?php // echo $form->field($model, 'elevator') ?>

    <?php // echo $form->field($model, 'heating') ?>

    <?php // echo $form->field($model, 'towels') ?>

    <?php // echo $form->field($model, 'linen') ?>

    <?php // echo $form->field($model, 'for_couples') ?>

    <?php // echo $form->field($model, 'for_family') ?>

    <?php // echo $form->field($model, 'for_friends') ?>

    <?php // echo $form->field($model, 'for_large_groups') ?>

    <?php // echo $form->field($model, 'for_wedings') ?>

    <?php // echo $form->field($model, 'total_privacy') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'changed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
