<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Camera */

$this->title = Yii::t('app', 'Create Camera');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cameras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
