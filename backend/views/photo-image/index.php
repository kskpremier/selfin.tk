<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhotoImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add New Image', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add New Image via REST/API', ['create-rest'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'date',
            [
                    'attribute'=>'camera_id',
                    'label'=>'Type of camera',
                    'value'=> 'camera.type'
            ],
            [
                'attribute'=>'booking_id',
                'label'=>'Reservation',
                'value'=> 'booking_id'
            ],
            [
                'attribute'=>'user_id',
                'label'=>'User',
                'value'=> 'user.username'
            ],
            [
                'attribute'=>'album_id',
                'label'=>'Album',
                'value'=> 'album.name'
            ],
            [
                'attribute'=>'file_name',
                'label'=>'Image',
                //'value'=> 'album.name'
            ],
            [
                'label'=>'Preview',
                'format' => 'raw',
                'value' => function($data){
                    //return Html::img(Url::toRoute(Yii::getAlias('@imageUrl').'/'.$data->file_name),[
                    return Html::img(Yii::getAlias('@imageUrl').'/'.$data->file_name,[
                        'alt'=>'Preview',
                        'style' => 'width:25px;'
                    ]);
                },
            ],



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
