<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'unit_id') ?>

    <?= $form->field($model, 'object_type_id') ?>

    <?= $form->field($model, 'worker_id') ?>

    <?php // echo $form->field($model, 'cleaner_id') ?>

    <?php // echo $form->field($model, 'laundry_id') ?>

    <?php // echo $form->field($model, 'profile_id') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'erp_id') ?>

    <?php // echo $form->field($model, 'object_type_extra') ?>

    <?php // echo $form->field($model, 'item_id') ?>

    <?php // echo $form->field($model, 'guid') ?>

    <?php // echo $form->field($model, 'price_calculation') ?>

    <?php // echo $form->field($model, 'calculation_type') ?>

    <?php // echo $form->field($model, 'object') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'exchange') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'vat_advance') ?>

    <?php // echo $form->field($model, 'balance_payment') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'sort_front_page') ?>

    <?php // echo $form->field($model, 'web_page') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'note_long') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'advance_percent') ?>

    <?php // echo $form->field($model, 'review') ?>

    <?php // echo $form->field($model, 'owner_provision') ?>

    <?php // echo $form->field($model, 'web') ?>

    <?php // echo $form->field($model, 'instant') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'pay_casche') ?>

    <?php // echo $form->field($model, 'pay_iban') ?>

    <?php // echo $form->field($model, 'pay_paypal') ?>

    <?php // echo $form->field($model, 'pay_card') ?>

    <?php // echo $form->field($model, 'city_tax') ?>

    <?php // echo $form->field($model, 'guest_portal_details') ?>

    <?php // echo $form->field($model, 'own') ?>

    <?php // echo $form->field($model, 'front_page') ?>

    <?php // echo $form->field($model, 'door_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'changed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
