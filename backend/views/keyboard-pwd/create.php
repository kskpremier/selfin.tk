<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KeyboardPwd */

$this->title = Yii::t('app', 'Create Keyboard Pwd');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Keyboard Pwds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyboard-pwd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
