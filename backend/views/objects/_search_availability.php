<?php

use backend\helpers\RentsHelper;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rents-availability-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id'=>'availability'
        ],
    ]); ?>
    <div class = 'row'>

        <div class = "col-lg-4">
<!--                --><?php // echo $form->field($model, 'searchString')->label("Destination") ?>
            <?= $form->field($model,'reception')->dropDownList(RentsHelper ::getReceptionList())->label(false)?>
        </div>
        <div class = "col-lg-2">
                <?= $form->field($model, 'start')->widget(DatePicker::className(), [
                    'model' => $model,
                    'value' => $model->start,
                    'attribute' => 'start',
                    'options' => ['placeholder' => $model->start],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])->label(false);
                ?>
        </div>
        <div class = "col-lg-2">
                <?php // <?= $form->field($model, 'end_date')->textInput() ?>

                <?= $form->field($model, 'until')->widget(DatePicker::className(), [
                    'model' => $model,
            'value' => $model->until,
                    'attribute' => 'until',
                    'options' => ['placeholder' => 'To'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])->label(false);
                ?>
        </div>


        <div class = "col-lg-4">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
