<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Face */

$this->title = Yii::t('app', 'Create Face');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
