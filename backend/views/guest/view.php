<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Guest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-view">

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

            'first_name',
            'second_name',
            'contact_email:email',
            ['attribute'=>'documents',
                 'format' => 'raw',
                'value'=>function($model) {
                    $documentList='';
                    foreach($model->documents as $document) {
                        $documentList.= Html::a($document->number,['document/view','id'=>$document->id],['class' => 'thumbnail', 'target' => '_blank']);
                    }
                    return $documentList;
                },
            'label'=>'GuestList'],

        ],
    ]) ?>

</div>
