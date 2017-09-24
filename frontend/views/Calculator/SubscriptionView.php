<?php
//namespace frontend\views\Calculator;

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\Booking */

$this->title = "Subscription";
$this->params['breadcrumbs'][] = ['label' => 'Calculation', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Recalculate', ['calculate'], ['class' => 'btn btn-primary']) ?>

    </p>

    <div class="box">
        <div class="box-header with-border">Subscription details</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $form,
                'attributes' => [
                    [
                        'attribute' => 'square',
                        'value' => $form->square,
                    ],
                    [
                        'attribute' => 'volumeOfBooking',
                        'value' => $form->volumeOfBooking,
                        'format'=>'currency'
                    ],
                    [
                        'attribute' => 'beds',
                        'value' => $form->beds,
                    ],
                    [
                        'attribute' => 'numberOfCheckins',
                        'value' => $form->numberOfCheckins,
                    ],
                ],
            ]) ?>
        </div>
            <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'priceForCleaning',
                        'value' => $model->priceForCleaning,
                        'format'=>'currency'
                    ],
                    [
                        'attribute' => 'percentageRateForMultichannel',
                        'value' => $model->percentageRateForMultichannel,
                        'format'=>'percent'
                    ],
                    [
                        'attribute' => 'percentageRateForYielding',
                        'value' => $model->percentageRateForYielding,
                        'format'=>'percent'
                    ],
                    [
                        'attribute' => 'Total',
                        'value' => $model->Total,
                        'format'=>'currency'
                    ],
                    [
                        'attribute' => 'percentageTotal',
                        'value' => $model->percentageTotal,
                        'format'=>'percent'
                    ]
                ],
            ]) ?>
        </div>
    </div>


</div>
