<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Rents */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'object_id',
            'rent_status_id',
            'user_id',
            'cleaner_id',
            'customer_id',
            'item_id',
            'parent_rent_id',
            'guid',
            'type',
            'request_for_payment',
            'number',
            'from_date',
            'from_time',
            'from_time_confirm',
            'until_date',
            'until_time',
            'until_time_confirm',
            'note:ntext',
            'note_short',
            'note_user:ntext',
            'note_cancellation_policy:ntext',
            'discount',
            'price',
            'currency_id',
            'price_extra',
            'price_netto',
            'deposit',
            'rent_source_provision',
            'deposit_currency_id',
            'deposit_active',
            'price_with_vat',
            'price_with_city_tax',
            'paid',
            'money_recived',
            'in_advance_paid',
            'payment_method_id',
            'price_date',
            'exchange',
            'in_advance',
            'in_advance_exchange',
            'price_neto',
            'price_neto_exchange',
            'price_neto_currency_id',
            'in_advance_currency_id',
            'in_advance_date',
            'contact_name',
            'contact_type_id',
            'contact_email:email',
            'contact_tel',
            'contact_adress',
            'contact_city_zip',
            'contact_city',
            'contact_country_id',
            'confirm_datetime',
            'contact_confirm',
            'valid_date',
            'valid_time',
            'raiting',
            'rating_note:ntext',
            'rent_import_id',
            'rent_source_id',
            'foreign_id',
            'foreign_id_1',
            'foreign_id_2',
            'import_message:ntext',
            'erp_id',
            'door_pin',
            'door_pin_active',
            'owner',
            'searchable',
            'active_temp',
            'active',
            'opend',
            'confirmed_date',
            'canceled_date',
            'created',
            'changed',
        ],
    ]) ?>

</div>
