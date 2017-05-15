<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KeyboardPwdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Keyboard Pwds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyboard-pwd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Keyboard Pwd'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start_day',
            'end_day',
            'value',
            'keyboard_pwd_type',
            // 'keyboard_pwd_version',
            // 'door_lock_id',
            // 'booking_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
