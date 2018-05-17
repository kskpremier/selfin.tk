<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id'=>'rents'
        ],
    ]); ?>
    <div class = 'row'>
        <div class = "col-lg-8">
            <?php  echo $form->field($model, 'searchString')->label(false) ?>
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
