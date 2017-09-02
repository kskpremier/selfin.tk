<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FaceComparation */

$this->title = Yii::t('app', 'Create Face Comparation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Face Comparations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-comparation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
