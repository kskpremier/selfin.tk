<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhotoDocument */

$this->title = 'Create Photo Document';
$this->params['breadcrumbs'][] = ['label' => 'Photo Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
