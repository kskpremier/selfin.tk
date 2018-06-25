<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model reception\entities\Feefo\FeefoSales */

$this->title = 'Update Feefo Sales: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Feefo Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feefo-sales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
