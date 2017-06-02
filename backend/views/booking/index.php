<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [   'attribute'=>'id',
                'label'=>'Number'
            ],
            'arrival_date',
            'depature_date',
            [   'attribute'=> 'apartment.name',
                'label'=> 'Apartment'
            ],
            [   'attribute'=>'Guests',
                'value'=>function($model){
                    return count($model->guests);
                },
                'filter'=>false,
            ],

            [
                'label'=>'List of guest',

                'format' => 'raw',
                'value' => function($model){
                    $guestList='';
                    foreach ($model->guests as $guest){
                        $guestList .= '<p>'.Html::a($guest->second_name. ' '. $guest->first_name,
                                ['guest/view', 'id' => $guest->id],
                                ['class' => '']). PHP_EOL.'</p>';

                    }

                    return $guestList;

                },
            ],
            [
                'attribute'=>'author.second_name',
                'format' => 'raw',
                'value'=> function($guest){
                    return Html::a($guest->author->second_name. ' '. $guest->author->first_name,
                        ['guest/view', 'id' => $guest->id],
                        ['class' => '']);
                },
                'label'=>'Author'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {key} {pin}',
                'buttons' => [
                    'key' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-phone"></span>',
                            ['key/create', 'booking_id' => $model->id ],
                            ['class' => '']
                        );
                    },
                    'pin' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-th"></span>',
                            ['keyboard-pwd/create', 'booking_id' => $model->id ],
                            ['class' => '']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
