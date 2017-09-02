<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhotoRealFaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Real Faces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-real-face-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Photo Real Face', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'photo_image_id',
            'file_name',
            'album_id',
            // 'x1',
            // 'y2',
            // 'x2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
