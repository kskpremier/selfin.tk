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
    <div class="row">
    <p>You will compare this face : </p>
    <div class="col-md-11"><?php echo Html::img(Yii::getAlias('@imageUrl') . '/' . $originalFace->face_id . '.jpg', [
            'alt'=>'Preview',
            'style' => 'width:50px;'
        ]); ?>
    </div>
    <p> with your choice from the other in list</p>
    </div>
    <p>List:</p>
   <?php foreach ($facesList as $id=>$face) { ?>
       <div class="row">
           <div class="col-md-11"><?php echo Html::img(Yii::getAlias('@imageUrl') . '/' . $face->face_id . '.jpg', [
                   'alt'=>'Preview',
                   'style' => 'width:50px;'
               ]); ?></div>
           <div class="col-md-12"><?php echo $form->field($face, "[$id]isChecked")->checkbox()->label(false); ?> </div>
       </div>
   <?php }?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'face-compare') , ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>