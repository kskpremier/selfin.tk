<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model myrent\models\Objects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-view">

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
            'user_id',
            'unit_id',
            'object_type_id',
            'worker_id',
            'cleaner_id',
            'laundry_id',
            'profile_id',
            'type',
            'erp_id',
            'object_type_extra',
            'item_id',
            'guid',
            'price_calculation',
            'calculation_type',
            'object',
            'name',
            'color',
            'picture',
            'price',
            'exchange',
            'currency_id',
            'vat',
            'vat_advance',
            'balance_payment',
            'sort',
            'sort_front_page',
            'web_page',
            'note:ntext',
            'note_long:ntext',
            'description:ntext',
            'advance_percent',
            'review',
            'owner_provision',
            'web',
            'instant',
            'active',
            'details',
            'pay_casche',
            'pay_iban',
            'pay_paypal',
            'pay_card',
            'city_tax',
            'guest_portal_details',
            'own',
            'front_page',
            'door_id',
            'created',
            'changed',
        ],
    ]) ?>

</div>
