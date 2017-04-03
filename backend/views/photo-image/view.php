<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoImage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-image-view">

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
            [   'attribute'=>'camera_id',
                'value' => $model->camera->type,
                'label'=>'Camera type'
            ],
            [   'attribute'=>'album_id',
                'value'=> $model->album->name,
                'label'=>'Album'
            ],
            [   'attribute'=>'file_name',
                'value'=>Yii::getAlias('@imageUrl').'/'.$model->file_name,
               'format'=>['image', [
                                   'width'=>'100px',
                                   //'height'=>130
                                   ],
                       ],
                'label'=>'Image Preview'
            ],
        ],
    ]) ?>
    <?= Html::a('Send image for faces recognition',
                 ['faces/detect-face', 'imageUrl' => Yii::getAlias('@imageUrl').'/'.$model->file_name],
                 ['class' => 'btn btn-primary']) ?>
</div>
