<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocument */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-document-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',


            [   'attribute'=>'album_id',
                'value'=> $model->album->name,
                'label'=>'Album'
            ],
            [   'attribute'=>'file_name',
                'format' => 'raw',
                'value'=>Html::a(
                    Html::img($model->getThumbFileUrl('file_name', 'thumb')),
                    $model->getUploadedFileUrl('file_name'),
                    ['class' => 'thumbnail', 'target' => '_blank']),

                 //   $model->getThumbFileUrl('file_name','thumb'),//Yii::getAlias('@documentUrl').'/'.$model->file_name,
//                'format'=>['image', [
//                    'width'=>'100px',
//                    //'height'=>130
//                ],
//                ],
                'label'=>'Preview'
            ],

        ],
    ]) ?>

</div>
