<?php


use backend\models\ObjectsRealestates;
use kartik\checkbox\CheckboxX;
use kartik\slider\Slider;
use reception\helpers\MyRentHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<!--    Детальный фильтр старт-->
<div class="row" id="details-filter">
    <div class="row">
        <h1>Filter By:</h1>

    </div>

<!--    --><?php //$form = ActiveForm::begin([
//        'action' => ['objects/search'],
//        'method' => 'get',
//        'options' => [
//            'data-pjax' => 4,
//            'id'=>'form-detail-filter'
//        ],
//        ]);?>
    <div class="row">
        <div class="col-lg-12">
            <h3>Price</h3>
            <?php echo
//            '<b class="badge">$25</b>'.$form->field($detailFilter, 'priceRange')->widget(Slider::className(),[
                '<b class="badge">&#x20ac;25</b> ' . Slider::widget([
                    'name'=>'priceRange',
                    'value'=>'35,70',
                    'sliderColor'=>Slider::TYPE_PRIMARY,
                    'pluginOptions'=>[
                        'min'=>25,
                        'max'=>300,
                        'step'=>5,
                        'range'=>true
                    ],
                ]).'<b class="badge">&#x20ac;300</b>'
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Stars</h3>
            <?php
            $list = [5 => '5 Stars', 4 => '4 Stars',3 => '3 Stars',2 => '5 Stars',2 => '2 Stars',1 => '1 Stars'];
            echo
            $form->field($detailFilter, 'stars')->checkboxList($list);
            ?>
        </div>
    </div>

    <div class="row"  >
        <div class="col-lg-12">
            <h3>Facility</h3>
            <?php
            $list = ["Y" => 'Y', "N" => 'N'];
            foreach ($detailFilter->facilities->attributes as $key=>$attribute):
                echo  $form->field($detailFilter->facilities, $key)->widget (CheckboxX::className(),['data'=>$list]);
            endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Room Facility</h3>
            <?php
            //            $list = ["Y" => 'Y', "N" => 'N'];
            foreach ($detailFilter->values as $key=>$value): ?>
                <div class="row" >
            <?php
                $type = MyRentHelper::getType(ObjectsRealestates::className(),$key);
                if ( $type == 'integer' || $type == 'float'|| $type == 'double'): ?>

                    <div class="col-md-6">
                        <h5><?=$key?></h5>
                    </div>
                    <div class="col-md-3">
                        from :
                         <?= $form->field($value, '[' . $key . ']from')->textInput()->label(false) ?>
                    </div>
                    <div class="col-md-3">
                        to :
                        <?= $form->field($value, '[' . $key . ']to')->textInput()->label(false) ?>
                    </div>
            <?php    elseif (strpos($type,'enum')!==false) : ?>
                    <?=$form->field($value,'[' . $key . ']equal')->checkbox()->label($key);?>
            <?php      else : ?>
                    <div class="col-md-6">
                        <h5><?=$key?></h5>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($value, '[' . $key . ']equal')->textInput()->label(false); ?>
                    </div>
              <?php
                endIf; ?>
                </div>
            <?php
                endforeach;
                ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Find', ['class' => 'btn btn-success']) ?>
    </div>

            <?php ActiveForm::end(); ?>
</div>


<!--    Детальный фильтр конец -->