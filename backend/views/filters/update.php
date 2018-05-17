<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Filters */

$this->title = 'Update Filters: '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Filters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="filters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'dataProvider'=>$dataProvider,
        'searchModel'=>$search,
        'model' => $model,
    ]) ?>

</div>
