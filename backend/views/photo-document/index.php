<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhotoDocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add New Document', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'date',
            //'application_id',

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
                    return Html::img(Yii::getAlias('@documentUrl').'/'.$data->file_name,[
                        'alt'=>'Preview',
                        'style' => 'width:25px;'
                    ]);
                },
            ],
            //'album_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
