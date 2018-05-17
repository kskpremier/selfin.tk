<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectsPricesDaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objects Prices Days';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-prices-days-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Objects Prices Days', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'object_id',
            'item_id',
            'group_id',
            //'stock',
            //'day',
            //'check_in',
            //'check_out',
            //'price',
            //'price_b2b',
            //'price_special',
            //'min_stay',
            //'days_before',
            //'price_extra',
            //'price_extra_child',
            //'extra_from',
            //'enable',
            //'created',
            //'changed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
