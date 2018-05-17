<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsRealestates */

$this->title = 'Create Objects Realestates';
$this->params['breadcrumbs'][] = ['label' => 'Objects Realestates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-realestates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
