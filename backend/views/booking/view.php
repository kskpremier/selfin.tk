<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\KeySearch;

/* @var $this yii\web\View */
/* @var $model backend\models\Booking */

$this->title = "Booking #".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-view">

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

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'start_date',
            'end_date',
            ['attribute'=>'apartment_id',
                'value'=>$model->apartment->name,
                'label'=>'Apartment'],
            ['attribute'=>'number_of_tourist',
                'label'=> 'Number of guests'],
            ['attribute'=>'guest_id',
              'label'=>'Guest list',
              'format'=>'raw',
              'value'=>function ($model) {
                    $guestList='';
                    foreach ($model->guests as $guest){
                        $guestList .= '<p>'.Html::a($guest->second_name. ' '. $guest->first_name,
                                ['guest/view', 'id' => $guest->id],
                                ['class' => '']). PHP_EOL.'</p>';
                    }
                    return $guestList;
                },
            ],
        ],
    ]);

    $searchModel = new KeySearch();
    $searchModel->booking_id = $model->id;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    echo $this->render('/key/index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
    echo Html::a(Yii::t('app', 'Send E-Key'), ['key/create','booking_id'=>$model->id], ['class' => 'btn btn-success']);
    $searchModel = new \backend\models\KeyboardPwdSearch();
    $searchModel->booking_id = $model->id;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    echo $this->render('/keyboard-pwd/index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
    echo Html::a(Yii::t('app', 'Get new password'), ['keyboard-pwd/create','booking_id'=>$model->id], ['class' => 'btn btn-success']);
    $searchModel = new \backend\models\PhotoImageSearch();
    $searchModel->booking_id = $model->id;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    echo $this->render('/photo-image/index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);

    ?>


</div>
