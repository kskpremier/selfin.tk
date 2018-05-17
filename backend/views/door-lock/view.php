<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */

$this->title = "Door lock :  ".$model->lock_alias;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Door Locks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="door-lock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'lock_alias','label'=>'Name'],
            ['attribute'=>'apartmentName',
                'label'=>'Apartment',

                'format'=>'raw',
                'value'=> function($model) {
                    $names ='';
                    foreach ($model->apartments as $apartment)
                    {
                        $names.= HTML::a('<span class="glyphicon glyphicon-home"> </span>'.$apartment->name. ' ', Url::to(['apartment/view', 'id' => $apartment->id]));
                    }

                    return ($names=='')? HTML::tag('span',' - ',['class'=>'danger']).
                        Html::a(Yii::t('app', 'Install'), ['install', 'lock' => $model->id], ['class' => 'btn btn-primary']).
                        Html::a(Yii::t('app', 'Uninstall'), ['uninstall', 'lock' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to uninstall door lock?'),
                                'method' => 'post',
                            ],
                        ])
                        : $names. Html::a(Yii::t('app', 'Install'), ['install', 'lock' => $model->id], ['class' => 'btn btn-primary']).
                        Html::a(Yii::t('app', 'Uninstall'), ['uninstall', 'lock' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to uninstall door lock?'),
                                'method' => 'post',
                            ],
                        ]);
                } ,
            ],

            'electric_quantity',
//        'lock_name',
        'lock_mac',

//        'admin_pwd',
        'no_key_pwd',
//        'delete_pwd',
//        'timestamp',

        'model_number',
        'hardware_revision',
        'firmware_revision',



        ],
    ]) ?>

<div class ="row">

    <?php

    echo $this->render('/key/index', [
    'searchModel' => $keySearch,
    'dataProvider' => $keysDataProvider,
    ]);

    ?>
</div>
    <div class ="row">
        <?php
        echo $this->render('/keyboard-pwd/index', [
        'searchModel' => $passwordSearch,
        'dataProvider' => $passwordsDataProvider,
        'user'=>Yii::$app->user->identity->getUserModel()
        ]);
       ?>
    </div>
</div>

</div>
