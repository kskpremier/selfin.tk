<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocumentFace */

$this->title = 'Create Photo Document Face';
$this->params['breadcrumbs'][] = ['label' => 'Photo Document Faces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-document-face-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
