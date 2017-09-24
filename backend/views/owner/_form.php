<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Owner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="owner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'externalId')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'firstName')->textInput()->label("First name") ?>
    <?php echo $form->field($model, 'secondName')->textInput()->label("Second name") ?>
    <?= $form->field($model, 'contactEmail')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>

    <?= $form->field($model, 'apartments')->widget(Select2::className(), [
        'data'=> ArrayHelper::map(reception\entities\Apartment\Apartment::find()->all(),'id','name'),
//        'value'=>($model->type == '0')? 'Permanent':'Period',
        'options' => ['placeholder' => 'Select an apartment ...'],
        'pluginOptions' => [],
    ])->label('Apartment');?>


    <div class="form-group">
        <?= Html::submitButton( 'Create',  ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
