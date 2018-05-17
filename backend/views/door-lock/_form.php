<?php

use reception\entities\Apartment\Apartment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="door-lock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'apartment_id')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(Apartment::find()->forUser(Yii::$app->getUser()->getId())->all(),'id','name'),
//        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select an apartment ...'],
        'pluginOptions' => [],
    ])->label('Apartment');?>

    <?= $form->field($model, 'lock_name')->textInput(['maxlength' => true])->label('Name') ?>
    <?= $form->field($model, 'lock_id')->textInput(['maxlength' => true])->label('ID given after INIT') ?>
    <?= $form->field($model, 'lock_mac')->textInput(['maxlength' => true])->label('MAC given after INIT') ?>
    <?= $form->field($model, 'admin_pwd')->textInput(['maxlength' => true])->label('Admin Password given after INIT') ?>
    <?= $form->field($model, 'timezone_raw_offset')->textInput(['maxlength' => true])->label('Admin Password given after INIT') ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
