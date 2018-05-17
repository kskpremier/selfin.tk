<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \reception\entities\User\User */
/* @var $document \reception\entities\Booking\Document */
/* @var $probability */

$link = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['document/view', 'id' => $document->id]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Result of recognition of your document image and face image has not enough level of probability:</p>

    <p> Level is <?= Html::encode($probability)?> % only,</p>

    <p><?= Html::a(Html::encode($link), $link) ?></p>
</div>