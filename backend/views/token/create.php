<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Token */

$this->title = Yii::t('app', 'Create Token');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="token-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
