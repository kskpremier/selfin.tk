<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\service\Draw;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faces');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Face'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'face_id',
            'x',
            'y',
            'width',
             'angle',
            [   'attribute'=>'photo_image_id',
                'value'=>
                    function($model) {
//                    $image = (new Draw($model->photoImage))->getFaceRectangleImage($model);
//                    return ($image)?$image:"-";
//                },
                        return Yii::getAlias('@imageUrl') . '/' . $model->face_id . '.jpg';
                    },
                'format'=>['image'
                    , [
                    'width'=>'60px',
                    //'height'=>130
                ],
                ],
                'label'=>'Face Preview'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}{match}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['/face/view', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['/face/delete', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'match' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-globe"></span>',
                            ['/face/compare-face', 'faceImageId' => $model->id ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
