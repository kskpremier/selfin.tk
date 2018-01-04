<?php

/* @var $this yii\web\View */
/* @var $user \reception\entities\User\User */
/* @var $document \reception\entities\Booking\Document */
/* @var $probability */

$link = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['document/view', 'id' => $document->id]);
?>

    Hello <?= Html::encode($user->username) ?>,

    Result of recognition of your document image and face image has not enough level of probability:

     Level is <?= $probability?> % only,

    <?=  $link ?>
