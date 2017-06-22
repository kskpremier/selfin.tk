<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
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
        <?= Html::a('Add New Image', ['photo-image/create'], ['class' => 'btn btn-success']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            ['attribute'=>'date',
                'filter'=>  DatePicker::widget([
                    'model' => $searchModel,
                    'language' => 'ru-RU',
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'options' => ['placeholder' => 'от'],
                    'options2' => ['placeholder' => 'до'],
                    'type' => DatePicker::TYPE_RANGE,
                    'separator'=>'-',
//                            'form' => $form,
                    'pluginOptions' => [
                        'todayHighLight'=>true,
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
                'format'=>'datetime'],
            [   'attribute'=>'status',
                'value'=> function ($model) {
    return ($model->status)? 'Recognized' : 'Raw'; },
                'label'=>'Status'
            ],
//            [
//                    'attribute'=>'camera_id',
//                    'label'=>'Type of camera',
//                    'value'=> 'camera.type'
//            ],
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
//            [
//                'attribute'=>'album_id',
//                'label'=>'Album',
//                'value'=> 'album.name'
//            ],
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



            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['photo-image/view', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['photo-image/delete', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'match' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['face/compearing-face', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
