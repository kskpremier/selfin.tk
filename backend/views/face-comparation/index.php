<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaceComparationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Face Comparations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-comparation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Face Comparation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'origin_id',
            [   'attribute'=> 'origin_id',
                'value'=> function($model) {
                    return Yii::getAlias('@imageUrl') . '/' . $model->origin->face_id . '.jpg';
                },
                'format'=>['image'
                    , [
                        'width'=>'60px',
                    ],
                    ],
            ],
                'face_id',
                [   'attribute'=> 'face_id',
                    'value'=> function($model) {
                        return Yii::getAlias('@imageUrl') . '/' . $model->face_id . '.jpg';
                    },
                    'format'=>['image'
                        , [
                            'width'=>'60px',
                        ],
                    ],
                ],

            'probability',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
