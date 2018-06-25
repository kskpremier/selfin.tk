<?php

/* @var $this yii\web\View */
/* @var $object Objects */

use backend\models\Objects;
use reception\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$url = Url::to(['object', 'id' =>$object->id]);

?>

<div class="product-layout product-list col-xs-12">
    <div class="product-thumb">
            <div class="image">
                <a href="<?= Html::encode($url) ?>">
                    <img src="<?= "https://api.my-rent.net/objects/picture_main/".$object->id ?>" alt="" class="img-responsive" style="width: 282px;" />
                </a>
            </div>
        <div>
            <div class="caption">
                <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($object->name) ?></a></h4>
            </div>
            <div class="button-group">

            </div>
        </div>
    </div>
</div>
