<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model reception\entities\MyRent\FeefoSchedule */

$this->title = Yii::t('app', 'Create Feefo Schedule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feefo Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $form,
        'dataProvider'=> $dataProvider,
        'searchModel'=>$searchModel
    ]) ?>

</div>
