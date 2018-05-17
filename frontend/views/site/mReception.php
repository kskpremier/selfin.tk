<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'mReception';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-3">
                <video  width="480" height="260" autoplay loop>
                    <source src="css/images/Short_scan.mp4" type="video/mp4">
                </video>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <div class="row">
<!--        <h1>Congratulations!</h1>-->

<!--        <p class="lead">--><?//=Yii::t('mReception','You have successfully discovered technology that makes you hospitality nice and innovative')?><!--</p>-->
        </div>
<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">--><?//=Yii::t('mReception','Get started with SelfIn')?><!--</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <?=Html::img("css/images/test.png",['class'=>'adaptive-foto'])?>
                </div>
                <div class="row">
                    <h2><?=Yii::t('mReception','Guest registration')?></h2>

                    <p><?=Yii::t('mReception','eVisitor compatible, secure and trusted technology helps you and your gusets make checkin/checkout process as easiest as possible. 20 seconds and 3 clicks for 1 passport registration. ')?></p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/"><?=Yii::t('mReception','Learn more')?> &raquo;</a></p>
                </div>

            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('mReception','Smart door locks')?></h2>

                <p><?=Yii::t('mReception','3-way new generation of door locks help you forget about difficult process of keys given for you tourists.')?></p>
                <p><?=Yii::t('mReception','Your guest will checkin/checkout 24X7X365 and you will have pleasure and will not spend any minutes for meeting guests.')?> </p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/"><?=Yii::t('mReception','Learn more')?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('mReception','Facial recognition')?></h2>

                <p><?=Yii::t('mReception','With new facial recognition technology you can be protected and defensed from fraud and non-legal guest registration.')?></p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/"><?=Yii::t('mReception','Learn more')?> &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
