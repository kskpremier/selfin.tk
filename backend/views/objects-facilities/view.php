<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsFacilities */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objects Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-facilities-view">

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
            'object_id',
            'seaview',
            'babycot',
            'breakfast',
            'halfboard',
            'fullboard',
            'berth',
            'jacuzzi',
            'terrace',
            'tv_satelite',
            'wifi',
            'internet_fast',
            'internet',
            'smoking',
            'luxurious',
            'air_conditioning',
            'tv_lcd',
            'wheelchair_accessible',
            'near_beach',
            'pets',
            'near_country',
            'near_city',
            'in_city',
            'in_country',
            'swimming_pool',
            'swimming_pool_indoor',
            'swimming_pool_indoor_heated',
            'swimming_pool_outdoor',
            'swimming_pool_outdoor_heated',
            'parking',
            'sauna',
            'gym',
            'separate_kitchen',
            'elevator',
            'heating',
            'towels',
            'linen',
            'for_couples',
            'for_family',
            'for_friends',
            'for_large_groups',
            'for_wedings',
            'total_privacy',
            'created',
            'changed',
        ],
    ]) ?>

</div>
