<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 20.06.17
 * Time: 7:12
 */

use backend\helpers\DoorLockHelper;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */

$this->title = Yii::t('app', 'Unsetting Door Lock from Apartment (s)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Door Locks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->id = $id;
$model->lock_alias = $doorLock->lock_alias;
?>
<div class="door-lock-create">
    <?php $form = ActiveForm::begin([ 'id' => 'uninstall-form',]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id, 'name'=>'id'])->label(false); ?>
    <?= $form->field($model, 'lockAlias')->textInput(['options'=>['value'=>$model->lockAlias]]) ->label('Set new name for door lock, if needed')?>
    <?php foreach ($apartmentListArray as $id=>$name) { ?>

        <?php
        echo '<label class="cbx-label" for="'.$id.'">'. $name .'</label>';
        echo CheckboxX::widget([

            'name'=>'DoorLockInstallForm[apartmentList]['.$id.']',
            'options'=>['id'=>$id],
            'value'=>1,
            'pluginOptions'=>['threeState'=>false,
                'size'=>'xl',
                'iconChecked'=>'<i class="glyphicon glyphicon-ok"></i>',
                'iconUnchecked'=>'<i class="glyphicon glyphicon-remove"></i>',
                 ]
        ]);

?>

    <?php }?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>
</div>