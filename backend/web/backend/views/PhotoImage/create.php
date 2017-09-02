<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhotoImage */

$this->title = 'Create Photo Image';
$this->params['breadcrumbs'][] = ['label' => 'Photo Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
