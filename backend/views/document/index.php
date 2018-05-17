<?php

use reception\helpers\ImageHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Document'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'first_name',
            'second_name',
            'number',
//            [
//                'attribute' => 'id',
//                'filter' => ::statusList(),
//                'value' => function (User $model) {
//                    return UserHelper::statusLabel($model->status);
//                },
//                'format' => 'raw',
//            ],
            [ "attribute"=>'maxprobability',
                'format' => 'raw',
                'value' => function($model) {
                    return ImageHelper::statusRecognition($model->maxprobability);
                }
            ],
            [   'attribute'=>'images',
                'format' => 'raw',
                'value'=>function($model) {
                    $imageBlock='';
                    foreach($model->documentImages as $image) {

                        $imageBlock = $imageBlock. Html::tag('span',Html::img($image->getThumbFileUrl('file_name', 'thumb'),
                            ['class' => 'thumbnail', 'target' => '_blank']),['class'=>'row']);

                    }
                    return $imageBlock;
                },
                'label'=>'Preview'
            ],
            // 'date_of_issue',
            // 'photo_document_face_id',
            // 'document_type_id',
            // 'country_id',
            // 'valid_before',
            // 'photo_document_id',
            // 'guest_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}{update}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['document/view', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['document/update', 'id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['document/delete', 'id' => $model->id ],
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
