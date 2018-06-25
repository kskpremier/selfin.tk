<?php

use reception\helpers\UserHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\rbac\Item;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model reception\entities\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    ['attribute'=>'external_id',
                        'label'=>"MyRentReception User Id"],
                    [   'attribute'=>'myrent_update',
                        'value'=> function($model){
                                $value = ($model->myrent_update)? date("Y-m-d H:i:s",$model->myrent_update):'';
                                return $value.' '.UserHelper::getSynchroTime($model);
                        },
                        'label'=>"mReception Last Update",
                        'format'=>'raw'
                    ],
                    'username',
                    'email:email',
//                    'phone',
                    [
                        'attribute' => 'status',
                        'value' => UserHelper::statusLabel($model->status),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Role',
                        'value' => implode(', ', ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($model->id), 'name')),
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
