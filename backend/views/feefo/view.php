<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model reception\entities\Feefo\FeefoSales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Feefo Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feefo-sales-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            ['attribute'=>'rent_id',],

            ['attribute'=>'created',
                'value'=>date("Y-M-d", $model->created)
            ],
            'log:ntext',
            'params:ntext',
            ['attribute'=>'email',
                'value'=>function($model){
                    $params = json_decode($model->params,true);
                    return $params['email'];
                }
            ],
            ['attribute'=>'name',
                'value'=>function($model){
                    $params = json_decode($model->params,true);
                    return $params['name'];
                }
            ],
            ['attribute'=>'params',
                'label'=>'For CSV',
                'value'=>function ($model){
                $array = json_decode($model->params, true);

                foreach ($array as $key=>$value) {
                    $array[$key]=(!stristr($value,','))?$value:'"'.$value.'"';
                }
                    $keys = array_keys($array);
                    $values = array_values($array);
                   $result = implode(',',$keys).PHP_EOL.implode(',',$values);
                   return $result;
                }
            ],
            ['attribute'=>'file',
                'label'=>'File CSV',
                'format'=>'raw',
                'value'=>function ($model){
                            $fileName = Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",$model->created)."_vipholiday_rents.csv";
                            $short = 'download';
                        return ($model->log!="Not sent. Email is in stop list!")? Html::a( '  Download',['/feefo/download','fileName'=>$fileName],
                            ['class'=>'glyphicon glyphicon-download-alt', 'title'=>'Download CSV']) :'';
                }
            ]
        ],
    ]) ?>

</div>
