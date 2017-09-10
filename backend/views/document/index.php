<?php

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

            'first_name',
            'second_name',
            'number',

            [   'attribute'=>'images',
                'format' => 'raw',
                'value'=>function($model) {
                    $imageBlock='';
                    foreach($model->images as $image) {

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
