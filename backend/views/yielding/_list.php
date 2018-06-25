<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="row">
    <?php foreach ($dataProvider->query->all() as $object): ?>
        <?= $this->render('_object', [
            'object' => $object
        ]) ?>
    <?php endforeach; ?>
</div>

<div class="row">
    <div class="col-sm-6 text-left">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
    <div class="col-sm-6 text-right">Showing <?= $dataProvider->getCount() ?> of <?= $dataProvider->getTotalCount() ?></div>
</div>