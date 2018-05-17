<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectsRealestatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objects Realestates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-realestates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Objects Realestates', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'object_id',
            'object_type_id',
            'property_type_id',
            'object_name_id',
            //'name',
            //'motto',
            //'note:ntext',
            //'description:ntext',
            //'can_sleep_max',
            //'promotion_id',
            //'can_sleep_optimal',
            //'beds',
            //'beds_extra',
            //'bathrooms',
            //'bedrooms',
            //'toilets',
            //'baby_coat',
            //'high_chair',
            //'floor',
            //'min_stay',
            //'changeover',
            //'wifi_network',
            //'wifi_password',
            //'check_in',
            //'check_out',
            //'security_deposit_type',
            //'security_deposit',
            //'down_deposit_type',
            //'down_deposit',
            //'smoking',
            //'luxurius',
            //'air_conditioning',
            //'internet',
            //'wheelchair_accessible',
            //'pets',
            //'swimming_pool',
            //'parking',
            //'loc_beach',
            //'loc_country',
            //'loc_city',
            //'cleaning_price',
            //'space',
            //'space_yard',
            //'standard_guests',
            //'tripadvisor_review',
            //'classification_star',
            //'price_standard',
            //'guest_review',
            //'created',
            //'changed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
