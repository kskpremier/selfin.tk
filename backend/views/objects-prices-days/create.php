<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ObjectsPricesDays */

$this->title = 'Create Objects Prices Days';
$this->params['breadcrumbs'][] = ['label' => 'Objects Prices Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-prices-days-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
