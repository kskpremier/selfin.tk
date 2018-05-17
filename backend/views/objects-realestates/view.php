<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsRealestates */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Objects Realestates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-realestates-view">

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
            'object_type_id',
            'property_type_id',
            'object_name_id',
            'name',
            'motto',
            'note:ntext',
            'description:ntext',
            'can_sleep_max',
            'promotion_id',
            'can_sleep_optimal',
            'beds',
            'beds_extra',
            'bathrooms',
            'bedrooms',
            'toilets',
            'baby_coat',
            'high_chair',
            'floor',
            'min_stay',
            'changeover',
            'wifi_network',
            'wifi_password',
            'check_in',
            'check_out',
            'security_deposit_type',
            'security_deposit',
            'down_deposit_type',
            'down_deposit',
            'smoking',
            'luxurius',
            'air_conditioning',
            'internet',
            'wheelchair_accessible',
            'pets',
            'swimming_pool',
            'parking',
            'loc_beach',
            'loc_country',
            'loc_city',
            'cleaning_price',
            'space',
            'space_yard',
            'standard_guests',
            'tripadvisor_review',
            'classification_star',
            'price_standard',
            'guest_review',
            'created',
            'changed',
        ],
    ]) ?>

</div>
