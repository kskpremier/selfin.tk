<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsRealestatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-realestates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'object_type_id') ?>

    <?= $form->field($model, 'property_type_id') ?>

    <?= $form->field($model, 'object_name_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'motto') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'can_sleep_max') ?>

    <?php // echo $form->field($model, 'promotion_id') ?>

    <?php // echo $form->field($model, 'can_sleep_optimal') ?>

    <?php // echo $form->field($model, 'beds') ?>

    <?php // echo $form->field($model, 'beds_extra') ?>

    <?php // echo $form->field($model, 'bathrooms') ?>

    <?php // echo $form->field($model, 'bedrooms') ?>

    <?php // echo $form->field($model, 'toilets') ?>

    <?php // echo $form->field($model, 'baby_coat') ?>

    <?php // echo $form->field($model, 'high_chair') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'min_stay') ?>

    <?php // echo $form->field($model, 'changeover') ?>

    <?php // echo $form->field($model, 'wifi_network') ?>

    <?php // echo $form->field($model, 'wifi_password') ?>

    <?php // echo $form->field($model, 'check_in') ?>

    <?php // echo $form->field($model, 'check_out') ?>

    <?php // echo $form->field($model, 'security_deposit_type') ?>

    <?php // echo $form->field($model, 'security_deposit') ?>

    <?php // echo $form->field($model, 'down_deposit_type') ?>

    <?php // echo $form->field($model, 'down_deposit') ?>

    <?php // echo $form->field($model, 'smoking') ?>

    <?php // echo $form->field($model, 'luxurius') ?>

    <?php // echo $form->field($model, 'air_conditioning') ?>

    <?php // echo $form->field($model, 'internet') ?>

    <?php // echo $form->field($model, 'wheelchair_accessible') ?>

    <?php // echo $form->field($model, 'pets') ?>

    <?php // echo $form->field($model, 'swimming_pool') ?>

    <?php // echo $form->field($model, 'parking') ?>

    <?php // echo $form->field($model, 'loc_beach') ?>

    <?php // echo $form->field($model, 'loc_country') ?>

    <?php // echo $form->field($model, 'loc_city') ?>

    <?php // echo $form->field($model, 'cleaning_price') ?>

    <?php // echo $form->field($model, 'space') ?>

    <?php // echo $form->field($model, 'space_yard') ?>

    <?php // echo $form->field($model, 'standard_guests') ?>

    <?php // echo $form->field($model, 'tripadvisor_review') ?>

    <?php // echo $form->field($model, 'classification_star') ?>

    <?php // echo $form->field($model, 'price_standard') ?>

    <?php // echo $form->field($model, 'guest_review') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'changed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
