<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhotoDocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Photo Document', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'application_id',
            'file_name',
            'album_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
