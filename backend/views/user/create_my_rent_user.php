<?php

/* @var $this yii\web\View */
/* @var $model reception\forms\manage\User\UserCreateForm */

use yii\bootstrap\ActiveForm;

use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxLength' => true])->label("MyRent ID") ?>
    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'contact_name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'contact_tel')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'contact_email')->textInput(['maxLength' => true]) ?>

    <?= $form->field($model, 'guid')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'created')->widget(DateTimePicker::className(), [
        'name' => 'changed',
//        'attribute' => 'created',
        // 'options' => ['placeholder' => 'Created'],
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND ,
        'pluginOptions' => [
            'format' => 'dd-M-yyyy hh:ii:ss',
            'autoclose' => true,]
    ]);
    ?>
    <?= $form->field($model, 'changed')->widget(DateTimePicker::className(), [
        'name' => 'changed',
//        'attribute' => 'changed',
        //  'options' => ['placeholder' => 'Changed'],
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND ,
        'pluginOptions' => [
            'format' => 'dd-M-yyyy hh:ii:ss',
            'autoclose' => true,]
    ]);
    ?>

    <?= $form->field($model, 'role')->widget(Select2::className(),[
            'data'=> $model->rolesList(),
            'options' => ['placeholder' => 'Select roles for user ...','multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]
    )->label('Roles'); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
