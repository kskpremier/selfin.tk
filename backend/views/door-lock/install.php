<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 20.06.17
 * Time: 7:12
 */

use backend\helpers\DoorLockHelper;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */

$this->title = Yii::t('app', 'Install Door Lock in (for) Apartment (s)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Door Locks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->id = $doorLock->id;
$model->apartmentId = ArrayHelper::getColumn($doorLock->apartments,'id');
?>
<div class="door-lock-create">
    <?php $form = ActiveForm::begin([ 'id' => 'install-form',]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id, 'name'=>'id'])->label(false); ?>
    <?= $form->field($model, 'lockAlias')->textInput(['value'=>$doorLock->lock_alias]) ->label('New name for door lock')?>
    <?= $form->field($model, 'apartmentId')->widget(Select2::className(),[
        'data'=> ArrayHelper::map( DoorLockHelper ::getApartmentList($user_id) , 'id','name'),
        'value'=> $model->apartmentId,// ArrayHelper::map($doorLock->apartments,'id','name'),
        'options' => ['multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],


    ])->label("Apartment") ?>
    <div class="form-group">
        <?= Html::submitButton('Install', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>
</div>