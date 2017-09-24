<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\Owner */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'external_id',
            ['attribute'=>'user_id',
                'value'=> $model->user->username,
                'label'=>"Username"
            ],
            ['attribute'=>'apartments',
                'label'=>'Apartment list',
                'format'=>'raw',
                'value'=>function ($model) {
                    $apartmentList='';
                    foreach ($model->apartments as $apartment){
                        $apartmentList .= '<p>'.Html::a($apartment->name. ' '. $apartment->external_id,
                                ['apartment/view', 'id' => $apartment->id],
                                ['class' => '']). PHP_EOL.'</p>';
                    }
                    return $apartmentList;
                },
            ],
        ]
    ]) ?>

</div>
