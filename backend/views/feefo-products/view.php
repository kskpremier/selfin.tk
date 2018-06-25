<?php

use backend\helpers\FeefoHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model reception\entities\Feefo\FeefoProducts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feefo Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'object_id',
            ['attribute'=>'Name',
                'format'=>'raw',
                'value'=>function($model){
                    $params = json_decode($model->params,true);
                    return $params['title'];
                }
            ],
            ['attribute'=>'created',
                'value'=>date("Y-M-d", $model->created)
            ],
            ['attribute'=>'params',
            'label'=>'Json'],
            ['attribute'=>'params',
                'label'=>'For CSV',
                'value'=>function ($model){
                    $array = json_decode($model->params, true);
                    foreach ($array as $key=>$value) {
                        $array[$key]=(!stristr($value,','))?$value:'"'.$value.'"';
                    }
                    $keys = array_keys($array);
                    $values = array_values($array);
                    $result=implode(',',$keys).PHP_EOL.implode(',',$values);
                    return $result;
                }
            ],
            ['attribute'=>'file',
                'label'=>'File CSV',
                'format'=>'raw',
                'value'=> function ($model) {
                    $fileName = Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",$model->created)."_vipholiday_objects.csv";
                    return Html::a('<span class="glyphicon glyphicon-download-alt"></span>',
                        ['download','fileName'=>$fileName],
                        ['title'=>'Get CSV file']);
                },
            ],

        ],
    ]) ?>

</div>
