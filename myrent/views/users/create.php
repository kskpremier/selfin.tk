<?php

/* @var $this yii\web\View */
/* @var $model reception\forms\manage\User\UserCreateForm */

use yii\bootstrap\ActiveForm;

use yii\helpers\Html;
use kartik\select2\Select2;

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
    <?php //$form->field($model, 'phone')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>

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
