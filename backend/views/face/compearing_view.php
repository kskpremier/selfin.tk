<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 06.06.17
 * Time: 14:46
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Face */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compearing-face-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($facesList as $id=>$probability) { ?>
        <div class="row">
            <div class="col-md-3"><?php echo Html::img(Yii::getAlias('@imageUrl') . '/' . $original->face_id . '.jpg', [
                    'alt'=>'Preview',
                    'style' => 'width:50px;'
                ]); ?></div>
            <div class="col-md-3"><?php echo Html::img(Yii::getAlias('@imageUrl') . '/' . key ($probability) . '.jpg', [
                    'alt'=>'Preview',
                    'style' => 'width:50px;'
                ]); ?></div>
            <div class="col-md-3"><?php echo Html::tag('p', $probability[key ($probability)],[]); ?></div>

        </div>
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'face-compare') , ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>