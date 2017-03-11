<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apartments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Apartment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'location',
            'name',
            'door_lock_id',
            'camera_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
