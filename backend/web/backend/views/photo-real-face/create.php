<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhotoRealFace */

$this->title = 'Create Photo Real Face';
$this->params['breadcrumbs'][] = ['label' => 'Photo Real Faces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-real-face-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
