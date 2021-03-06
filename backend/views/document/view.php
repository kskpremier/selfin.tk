<?php

use reception\helpers\ImageHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//$this->registerCssFile('/assets/makephoto.js');
?>



<div class="document-view">

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
        <?php echo  Html::a('Send image for faces recognition',
            ['document/process', 'id' => $model->id],
            ['class' => 'btn btn-primary']); ?>
        <?php echo  Html::a('Send to eVisitor',
            ['document/checkin', 'id' => $model->id],
            ['class' => 'btn btn-primary']); ?>

    </p>

    <div class="booth">
        <img src="http://192.168.1.4:29219/videostream.cgi?user=admin&pwd=12345678" id="photo" alt="Ваша фотография">
        <?php echo  Html::a('Make photo',
            ['document/snapshot', 'id' => $model->id],
            ['class' => 'btn btn-primary']); ?>
    </div>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'second_name',
            'gender',
            'number',
            'date_of_birth',
            'date_of_issue',
            [   'attribute'=>'document_type_id',
                'value' => $model->documentType->name],
            [   'attribute'=>'country_id',
                'value' => $model->citizenship->name,
                'label'=>'Citizenship'],
            'city',
            'address',
            [   'attribute'=>'country_of_birth_id',
                'value' => $model->birthCountry->name,
                'label'=>'Country of birth'],
            [   'attribute'=>'country_of_birth_id',
                'value' => $model->birthCitizenship->name,
                'label'=>'Citizenship of birth'],
            [   'attribute'=>'valid_before',
                'value'=> function ($model) {
                return $model->valid_before; },
            ],
//            [
//                'attribute'=>'status',
//                'format' => 'raw',
//                'value' => function($model) {
//
//                }
//            ],
            [ "attribute"=>'maxprobability',
                'format' => 'raw',
                'value' => function($model) {
                    return ImageHelper::statusRecognition($model->maxprobability);
                }
                ],
            [   'attribute'=>'images',
                'format' => 'raw',
                'value'=>function($model) {
                    $imageBlock='';
                    foreach($model->documentImages as $image) {

                        $imageBlock = $imageBlock. Html::tag('span',
                            Html::a(
                                Html::img($image->getThumbFileUrl('file_name', 'thumb')),
                                $image->getUploadedFileUrl('file_name'),
                                ['class' => 'thumbnail', 'target' => '_blank'])
                                ,['class'=>'row']).PHP_EOL;
//                        foreach($image->faces as $face){
//                            $imageBlock.= Html::img(Yii::getAlias('@imageUrl') . '/' . $face->face_id . '.jpg'.PHP_EOL,['class' => 'thumbnail', 'target' => '_blank']);
//                        }

                    }
                    return $imageBlock;
                },
                'label'=>'DocumentImages'
            ],
            [   'attribute'=>'faces',
                'format' => 'raw',
                'value'=>function($model) {
                    $imageBlock='';
                    foreach($model->selfys as $image) {

                            $imageBlock = $imageBlock . Html::tag('span',
                                    Html::a(
                                        Html::img($image->getThumbFileUrl('file_name', 'thumb')),
                                        $image->getUploadedFileUrl('file_name'),
                                        ['class' => 'thumbnail', 'target' => '_blank'])
                                    ,['class'=>'row']).PHP_EOL;

                    }
                    return $imageBlock;
                },
                'label'=>'Selfie'
            ],
            [   'attribute'=>'faces',
                'format' => 'raw',
                'value'=>function($model) {
                    $imageBlock='';
                    foreach($model->faceImages as $image) {

                            $imageBlock = $imageBlock . Html::tag('span',
                                    Html::a(
                                        Html::img($image->getFaceFileUrl(),['height'=>"120", 'width'=>"100"]),
                                        $image->getFaceFileUrl(),
                                        ['class' => 'image', 'target' => '_blank'])
                                    ,['class'=>'row']).PHP_EOL;
                        }

                    return $imageBlock;
                },
                'label'=>'Faces'
            ],





        ],
    ]) ?>

</div>
