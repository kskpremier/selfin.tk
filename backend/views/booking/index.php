<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use reception\helpers\BookingHelper;

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

            [   'attribute'=>'id',
                'label'=>'Number',
            ],
            [   'attribute'=>'external_id',
                'label'=>'MyRentReception #',
            ],
            ['attribute'=>'start_date',
                'label'=>'From',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start_date',
                    'value'=> function($model){
                        return ($model->start_date == 0)? '':  $model->start_date;
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
                //'format' => 'datetime',
                'value'=> function($model){
                    return ($model->start_date == 0)? '':  $model->start_date;
                }
            ],
            ['attribute'=>'end_date',
                'label'=>'To',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end_date',
                    'value'=> function($model){
                        return ($model->start_date == 0)? '':  $model->start_date;
                    },
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
                // 'format' => 'datetime',
                'value'=> function($model){
                    return ($model->end_date == 0)? '':  $model->end_date;
                },

            ],
            [   'attribute'=> 'apartmentName',
                'label'=> 'Apartment',
                'format' => 'raw',
                'value' => function($model){

                        return Html::a($model->apartment->name,
                                ['apartment/view', 'id' => $model->apartment->id],
                                ['class' => '']);
                },
            ],
            [   'attribute'=>'Guests',
                'value'=>function($model){
                    return count($model->guests);
                },
                'filter'=>false,
            ],

            [
                'label'=>'Guests',

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

//            [
//                'attribute'=>'author',
//                'format' => 'raw',
//                'value'=> function($guest){
//                    return (isset($guest->author))?Html::a($guest->author->second_name. ' '. $guest->author->first_name,
//                        ['guest/view', 'id' => $guest->id],
//                        ['class' => '']):'';
//                },
//                'label'=>'Author'
//            ],
            [
                'attribute' => 'status',
                'filter' => BookingHelper ::statusList(),
                'value' => function (\reception\entities\Booking\Booking $model) {
                    return BookingHelper::statusLabel($model->getCurrentStatus());
                },
                'format' => 'raw',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {key} {pin}',
                'buttons' => [
                    'key' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-phone"></span>',
                            ['key/create-for-booking', 'booking_id' => $model->id ],
                            ['class' => (isset ($model->apartment->doorLocks))?'btn':'btn disabled',
                                'title'=>'Send E-key for guest']//,
                                //'disabled'=>(isset ($model->apartment->doorlocks))?false:true]
                        );
                    },
                    'pin' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-th"></span>',
                            ['keyboard-pwd/create', 'booking_id' => $model->id ],
                            ['class' => (isset ($model->apartment->doorLocks))?'btn':'btn disabled',
                                'title'=>'Get Keyboard password',
                               ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
