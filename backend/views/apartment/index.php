<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Apartments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Apartment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
           ['attribute'=>'location',
               'value'=>function ($model) { return $model->city_name.' '.$model->adress; },
               ],
            'name',
            ['attribute'=>'doorLocks',
                'label'=>'Door Lock on object',
                'format'=>'raw',
                'value'=> function ($model) {
                    $doorLockList='';
                    foreach ($model->doorLocks as $doorLock){
                        $doorLockList .= '<p>'.Html::a($doorLock->lock_alias,
                                ['door-lock/view', 'id' => $doorLock->id],
                                ['class' => '']). PHP_EOL.'</p>';
                    }
                    return $doorLockList;
                },],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}  {lock}',
                'buttons' => [

                    'lock' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-lock"></span>',
                            ['door-lock/install', 'lock' => $model->id ],
                            ['class' => '',
                                'title'=>'Install door lock']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
