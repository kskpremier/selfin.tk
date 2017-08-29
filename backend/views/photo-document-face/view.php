<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocumentFace */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo Document Faces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-document-face-view">

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
            'photo_document_id',
            'file_name',
            'album_id',
            'x1',
            'y2',
            'x2',
        ],
    ]) ?>

</div>
