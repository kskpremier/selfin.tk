<?php

use backend\widgets\grid\RoleColumn;
use kartik\date\DatePicker;
use reception\entities\User\User;
use reception\helpers\UserHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create MyRentReception user', ['create-myrent'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [ [
                    'attribute' => 'username',
                    'value' => function (User $model) {
                        return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                    'email:email',
                    ['attribute' =>'external_id',
                        'label'=>'MyRent ID',
                        'value'=>function ($model){
                            return $model->external_id??'-';
                        }
                    ],
                    [
                        'attribute' => 'created_at',
                         'value'=>function ($model){
                            return date("Y-m-d", $model->created_at);
                        },
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ]),
                        'format' => 'raw',
                    ],

                    [
                        'attribute' => 'role',
                        'class' => RoleColumn::class,
                        'filter' => $searchModel->rolesList(),
                        'label' => 'Roles and permissions'
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => UserHelper::statusList(),
                        'value' => function (User $model) {
                            return UserHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'=> function($model){
                            $value = ($model->myrent_update)? date("Y-m-d H:i:s",$model->myrent_update):'';
                            return UserHelper::getSynchroTime($model);
                        },
                        'label'=>"Update",
                        'format' => 'raw',
                    ],
                    [
                            'attribute'=>'dependedUsers',
                            'format'=>'raw',
                        'value'=> function($model){
                            $result='';
                            foreach ($model->dependedUsers as $user)
                            {
                                $result .= '<div class="row">'. Html::a(Html::encode($user->username), ['view', 'id' => $model->id]) .'</div>';
                            }
                            return  $result;
                        },
                        'label'=>"Users",
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
