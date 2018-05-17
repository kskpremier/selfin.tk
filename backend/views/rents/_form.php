<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_id')->textInput() ?>

    <?= $form->field($model, 'rent_status_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'cleaner_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <?= $form->field($model, 'parent_rent_id')->textInput() ?>

    <?= $form->field($model, 'guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'single' => 'Single', 'group' => 'Group', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'request_for_payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'from_date')->textInput() ?>

    <?= $form->field($model, 'from_time')->textInput() ?>

    <?= $form->field($model, 'from_time_confirm')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'until_date')->textInput() ?>

    <?= $form->field($model, 'until_time')->textInput() ?>

    <?= $form->field($model, 'until_time_confirm')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note_short')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note_user')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note_cancellation_policy')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'price_extra')->textInput() ?>

    <?= $form->field($model, 'price_netto')->textInput() ?>

    <?= $form->field($model, 'deposit')->textInput() ?>

    <?= $form->field($model, 'rent_source_provision')->textInput() ?>

    <?= $form->field($model, 'deposit_currency_id')->textInput() ?>

    <?= $form->field($model, 'deposit_active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'price_with_vat')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'price_with_city_tax')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'paid')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'money_recived')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'in_advance_paid')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_method_id')->textInput() ?>

    <?= $form->field($model, 'price_date')->textInput() ?>

    <?= $form->field($model, 'exchange')->textInput() ?>

    <?= $form->field($model, 'in_advance')->textInput() ?>

    <?= $form->field($model, 'in_advance_exchange')->textInput() ?>

    <?= $form->field($model, 'price_neto')->textInput() ?>

    <?= $form->field($model, 'price_neto_exchange')->textInput() ?>

    <?= $form->field($model, 'price_neto_currency_id')->textInput() ?>

    <?= $form->field($model, 'in_advance_currency_id')->textInput() ?>

    <?= $form->field($model, 'in_advance_date')->textInput() ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_type_id')->textInput() ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_city_zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_country_id')->textInput() ?>

    <?= $form->field($model, 'confirm_datetime')->textInput() ?>

    <?= $form->field($model, 'contact_confirm')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'valid_date')->textInput() ?>

    <?= $form->field($model, 'valid_time')->textInput() ?>

    <?= $form->field($model, 'raiting')->textInput() ?>

    <?= $form->field($model, 'rating_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rent_import_id')->textInput() ?>

    <?= $form->field($model, 'rent_source_id')->textInput() ?>

    <?= $form->field($model, 'foreign_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foreign_id_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foreign_id_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'import_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'erp_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'door_pin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'door_pin_active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'owner')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'searchable')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'active_temp')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'opend')->textInput() ?>

    <?= $form->field($model, 'confirmed_date')->textInput() ?>

    <?= $form->field($model, 'canceled_date')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'changed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
