<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model reception\entities\Feefo\FeefoSales */

$this->title = 'Create Feefo Sales';
$this->params['breadcrumbs'][] = ['label' => 'Feefo Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-sales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
