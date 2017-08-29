<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="door-lock-form">

    <?php $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'apartment_id')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(\backend\models\Apartment::find()->all(),'id','name'),
        //'value'=>($apartmentName) ? $apartmentName :'',
        'options' => ['placeholder' => ($apartmentName) ? $apartmentName : 'Select an apartment ...'],
        'pluginOptions' => [],
    ])->label('Apartment');?>
    <?= $form->field($model, 'id')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(\backend\models\DoorLock::find()->all(),'id','lock_name'),
        'value'=>($model->id) ? $model->lock_name :'',
        'options' => ['placeholder' => 'Select a door lock ...'],
        'pluginOptions' => [],
    ])->label('Door Lock');?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Install') : Yii::t('app', 'Install'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
