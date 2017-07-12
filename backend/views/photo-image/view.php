<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Face;
use backend\models\FaceSearch;

/* @var $this yii\web\View */
/* @var $model backend\models\PhotoImage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-image-view">

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
        <?php echo (!$model->status)? Html::a('Send image for faces recognition',
            ['face/detect-face', 'photoImageId' => $model->id],
            ['class' => 'btn btn-primary']): ''; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id','facematika_id',
            'date',
//            [   'attribute'=>'camera_id',
//                'value' => $model->camera->type,
//                'label'=>'Camera type'
//            ],
//            [   'attribute'=>'album_id',
//                'value'=> $model->album->name,
//                'label'=>'Album'
//            ],

            [   'attribute'=>'file_name',
                'value'=> $model->file_name,
                'label'=>'File'
            ],
            [   'attribute'=>'size',
                'value'=> $model->size,
                'label'=>'Size'
            ],
            [   'attribute'=>'status',
                'value'=> ($model->status)? 'Recognized' : 'Raw',
                'label'=>'Status'
            ],
            [   'attribute'=>'booking_id',
                'value'=> $model->booking_id,
                'label'=>'Booking #'
            ],
            [   'attribute'=>'file_name',
                'value'=> Yii::getAlias('@imageUrl').'/'.$model->file_name,
               'format'=>['image', [
                                   'width'=>'100px',
                                   //'height'=>130
                                   ],
                       ],
                'label'=>'Image Preview'
            ],
        ],
    ]) ?>

<?php
    $searchModel = new FaceSearch();
    $searchModel->photo_image_id = $model->id;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    echo $this->render('/face/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]);
    ?>
</div>
