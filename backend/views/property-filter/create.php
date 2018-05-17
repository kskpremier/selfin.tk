<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PropertyFilter */

$this->title = 'Create Property Filter';
$this->params['breadcrumbs'][] = ['label' => 'Property Filters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-filter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
