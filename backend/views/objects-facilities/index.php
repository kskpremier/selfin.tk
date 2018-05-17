<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectsFacilitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objects Facilities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-facilities-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Objects Facilities', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'object_id',
            'seaview',
            'babycot',
            //'breakfast',
            //'halfboard',
            //'fullboard',
            //'berth',
            //'jacuzzi',
            //'terrace',
            //'tv_satelite',
            //'wifi',
            //'internet_fast',
            //'internet',
            //'smoking',
            //'luxurious',
            //'air_conditioning',
            //'tv_lcd',
            //'wheelchair_accessible',
            //'near_beach',
            //'pets',
            //'near_country',
            //'near_city',
            //'in_city',
            //'in_country',
            //'swimming_pool',
            //'swimming_pool_indoor',
            //'swimming_pool_indoor_heated',
            //'swimming_pool_outdoor',
            //'swimming_pool_outdoor_heated',
            //'parking',
            //'sauna',
            //'gym',
            //'separate_kitchen',
            //'elevator',
            //'heating',
            //'towels',
            //'linen',
            //'for_couples',
            //'for_family',
            //'for_friends',
            //'for_large_groups',
            //'for_wedings',
            //'total_privacy',
            //'created',
            //'changed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
