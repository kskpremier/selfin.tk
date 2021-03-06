<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model reception\entities\Apartment\Owner */

$this->title = 'Update Owner: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="owner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="owner-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'externalId')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'firstName')->textInput()->label("First name") ?>
        <?php echo $form->field($model, 'secondName')->textInput()->label("Second name") ?>
        <?= $form->field($model, 'contactEmail')->textInput(['maxLength' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>

        <?= $form->field($model->apartments, 'others')->widget(Select2::className(),[
            'data'=> $model->apartments->apartmentsList(),
            'value' => $model->apartments->apartmentExistingList(),
            'options' => ['placeholder' => 'Select an apartment ...','multiple' => true],
            'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 10
                ],
            ]
        )->label('Apartments of owner'); ?>



        <div class="form-group">
            <?= Html::submitButton( 'Update',  ['class' => 'btn btn-success' ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
