<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsPricesDays */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objects Prices Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-prices-days-view">

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
            'item_id',
            'group_id',
            'stock',
            'day',
            'check_in',
            'check_out',
            'price',
            'price_b2b',
            'price_special',
            'min_stay',
            'days_before',
            'price_extra',
            'price_extra_child',
            'extra_from',
            'enable',
            'created',
            'changed',
        ],
    ]) ?>

</div>
