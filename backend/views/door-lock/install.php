<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 20.06.17
 * Time: 7:12
 */
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DoorLock */

$this->title = Yii::t('app', 'Install Door Lock into Apartment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Door Locks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="door-lock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-install', [
        'model' => $model,
        'apartmentName'=>$apartmentName
    ]) ?>

</div>