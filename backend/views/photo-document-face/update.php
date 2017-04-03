<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocumentFace */

$this->title = 'Update Photo Document Face: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo Document Faces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="photo-document-face-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
