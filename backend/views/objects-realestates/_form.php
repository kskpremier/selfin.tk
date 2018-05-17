<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsRealestates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-realestates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_id')->textInput() ?>

    <?= $form->field($model, 'object_type_id')->textInput() ?>

    <?= $form->field($model, 'property_type_id')->textInput() ?>

    <?= $form->field($model, 'object_name_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'can_sleep_max')->textInput() ?>

    <?= $form->field($model, 'promotion_id')->textInput() ?>

    <?= $form->field($model, 'can_sleep_optimal')->textInput() ?>

    <?= $form->field($model, 'beds')->textInput() ?>

    <?= $form->field($model, 'beds_extra')->textInput() ?>

    <?= $form->field($model, 'bathrooms')->textInput() ?>

    <?= $form->field($model, 'bedrooms')->textInput() ?>

    <?= $form->field($model, 'toilets')->textInput() ?>

    <?= $form->field($model, 'baby_coat')->textInput() ?>

    <?= $form->field($model, 'high_chair')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'min_stay')->textInput() ?>

    <?= $form->field($model, 'changeover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wifi_network')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wifi_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_in')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_out')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'security_deposit_type')->textInput() ?>

    <?= $form->field($model, 'security_deposit')->textInput() ?>

    <?= $form->field($model, 'down_deposit_type')->textInput() ?>

    <?= $form->field($model, 'down_deposit')->textInput() ?>

    <?= $form->field($model, 'smoking')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'luxurius')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'air_conditioning')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'internet')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wheelchair_accessible')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'pets')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'swimming_pool')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'parking')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'loc_beach')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'loc_country')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'loc_city')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cleaning_price')->textInput() ?>

    <?= $form->field($model, 'space')->textInput() ?>

    <?= $form->field($model, 'space_yard')->textInput() ?>

    <?= $form->field($model, 'standard_guests')->textInput() ?>

    <?= $form->field($model, 'tripadvisor_review')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classification_star')->textInput() ?>

    <?= $form->field($model, 'price_standard')->textInput() ?>

    <?= $form->field($model, 'guest_review')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'changed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
