<?php

use yii\helpers\Html;
use yii\grid\GridView;
use reception\entities\User\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OwnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Owner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'external_id',
            ['attribute'=>'username',
                'value'=> function ($model) {
                            return $model->user->username;
                },
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
