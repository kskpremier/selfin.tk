<?php

use backend\helpers\RentsHelper;
use backend\helpers\UnitsHelper;
use backend\models\Filters;
use backend\models\ObjectsNames;
use backend\models\ObjectsRealestates;
use backend\models\ObjectsRealstatesPropertyTypes;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use backend\helpers\AvailabilityHelper;
use backend\helpers\CalendarHelper;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('/css/js/multifreezer.js');
$this->registerJsFile('/css/js/yielding.js');
?>
<div class="table-yielding">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?php $form = ActiveForm::begin([
        'action' => ['superuser/yield'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id'=>'availability'
        ],
    ]); ?>
<div class="objects-index">

        <?php
        Pjax::begin();
        $form = ActiveForm::begin([
            'action' => ['superuser/availability'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1,
                'id'=>'availability'
            ],
        ]);
        ?>
<div class="row">
    <div class="col-lg-1" style="text-align: center;  min-width: 200px !important; background-color: white;">
        <?= $form->field($search,'reception')->dropDownList(RentsHelper::getReceptionList())->label(false)?>
        <?= $form->field($search,'objectIds')->hiddenInput(['id'=>'objectIds'])->label(false)?>
    </div>
    <div  class="col-lg-1" style="text-align: center;">
                <?= $form->field($search, 'start')->widget(DatePicker::className(), [
                    'model' => $search,
                    'value' => $search->start,
                    'attribute' => 'start',
                    'options' => ['placeholder' => 'From'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])->label(false);
                ?>
    </div>
    <div class = "col-lg-1">
                <?= $form->field($search, 'until')->widget(DatePicker::className(), [
                    'model' => $search,
                    'value' => $search->until,
                    'attribute' => 'until',
                    'options' => ['placeholder' => 'To'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])->label(false);
                ?>
    </div>

    <div class = "col-lg-2">
    <?php  echo $form->field($search, 'property')->widget(Select2 ::classname(), [
        'options' => ['placeholder' => 'Property name...','multiple' => true],
        'pluginOptions' => [
                'allowClear' => true,
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
        'data'=> $objects,//RentsHelper::getApartments(), 'id','name'),
        'value'=> ($search->property)?$search->property:null,

    ])->label(false);?>
    </div>
    <div class = "col-lg-2">
    <?php
    echo $form->field($search, 'occupancy')->widget(Select2 ::classname(), [
        'options' => ['placeholder' => 'Occupancy > ..','multiple' => false],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
        'data'=> [1=>'All',0=>0,10=>10,20=>20,30=>30,40=>40,50=>50,60=>60,70=>70,80=>80,90=>90,100=>100],
        'value'=> $search->occupancy,

    ])
        ->label(false);
    ?>
    </div>
    <div class = "col-lg-3">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class = "col-lg-6">
        <?php  echo $form->field($search, 'filterName')->widget(Select2 ::classname(), [
            'options' => ['placeholder' => 'Filter','multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
            'data'=> ArrayHelper::map(Filters::find()->all(),'id','name'),
            'value'=> $search->filterName,

        ])
            ->label(false);?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-2">
    <?php $form = ActiveForm::begin([
        'id'=>'filter-form',
//            'method' => 'get',
    ]); ?>

    <?= $form->field($filterForm, 'name')->textInput(['placeholder'=>'New filter name'])->label(false) ?>
    </div>
    <div class="form-group col-lg-1">
        <?= Html::button('Save filter', ['class' => 'btn btn-primary', 'onClick'=>'buildFilter()']) ?>

    </div>
    <?php ActiveForm::end();
        Pjax::end();
    ?>
</div>

<div class="row">
    <div class="col-lg-2">
        <?php
        Pjax::begin();
        $form = ActiveForm::begin([
            'action' => ['superuser/price'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 3,
                'id'=>'change_price'
            ],
        ]);
        ?>
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($priceForm,'price')->textInput(['placeholder'=>'price EUR','id'=>'price'])->label(false)?>
            </div>
            <div class="col-md-5">
                <?= $form->field($priceForm,'min_stay')->textInput(['placeholder'=>'min stay', 'id'=>'min_stay'])->label(false)?>
                <?= $form->field($priceForm,'indexes')->hiddenInput(['id'=>'price-indexes'])->label(false)?>
                <?= $form->field($priceForm,'id')->hiddenInput(['id'=>'price-id'])->label(false)?>
                <?= $form->field($priceForm,'firstDay')->hiddenInput(['id'=>'first-day-id'])->label(false)?>
                <?= $form->field($priceForm,'prices')->hiddenInput(['id'=>'prices-id'])->label(false)?>
                <?= $form->field($priceForm,'stays')->hiddenInput(['id'=>'stays-id'])->label(false)?>
            </div>
            <div class="col-md-2">
                <?= Html::button('Set', ['class' => 'btn btn-primary', 'onClick'=>'price_change()']) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-10"></div>
</div>
<div class="row" id="details-filter-button">
    <div class="col-lg-2">
            <?= Html::button('More details filter', ['class' => 'btn btn-primary', 'onClick'=>'open_detail_filter()']) ?>
    </div>
</div>
<!--    Детальный фильтр старт-->
<div class="row" id="details-filter" hidden>
         <div class="col-lg-8">
             <div class="objects-realestates-form">

                 <?php $form = ActiveForm::begin([
                     'action' => ['superuser/detail'],
                     'method' => 'get',
                     'options' => [
                         'data-pjax' => 4,
                         'id'=>'form-detail-filter'
                     ],
                 ]); ?>


                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'property_type_id')->widget(Select2 ::classname(), [
                     'options' => ['placeholder' => 'Property type','multiple' => true],
                     'pluginOptions' => [
                         'tags' => true,
                         'tokenSeparators' => [',', ' '],
                         'maximumInputLength' => 10
                     ],
                     'data'=> ArrayHelper::map(ObjectsRealstatesPropertyTypes::find()->all(),'id','name'),
//                     'value'=> $detailFilter->realEstates->property_type_id,
                 ])
//                     ->label(false);?>
                 </div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'object_name_id')->widget(Select2 ::classname(), [
                     'options' => ['placeholder' => 'Object name type','multiple' => true],
                     'pluginOptions' => [
                         'tags' => true,
                         'tokenSeparators' => [',', ' '],
                         'maximumInputLength' => 10
                     ],
                     'data'=> ArrayHelper::map(ObjectsNames::find()->all(),'id','name'),
//                     'value'=> $detailFilter->realEstates->property_type_id,
                 ])
//                     ->label(false);
                 ?></div>


                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'can_sleep_max')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'promotion_id')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'can_sleep_optimal')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'beds')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'beds_extra')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'bathrooms')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'bedrooms')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'toilets')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'baby_coat')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'high_chair')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'floor')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'min_stay')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'changeover')->textInput(['maxlength' => true]) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'wifi_network')->textInput(['maxlength' => true]) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'wifi_password')->textInput(['maxlength' => true]) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'check_in')->textInput(['maxlength' => true]) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'check_out')->textInput(['maxlength' => true]) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'security_deposit_type')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'security_deposit')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'down_deposit_type')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'down_deposit')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'smoking')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'luxurius')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'air_conditioning')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'internet')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'wheelchair_accessible')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'pets')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'swimming_pool')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'parking')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'loc_beach')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'loc_country')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'loc_city')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '','value'=>'Y']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'cleaning_price')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'space')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'space_yard')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'standard_guests')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'tripadvisor_review')->textInput(['maxlength' => true]) ?></div>
                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'classification_star')->widget(Select2 ::classname(), [
                     'options' => ['placeholder' => 'Stars','multiple' => true],
                     'pluginOptions' => [
                         'tags' => true,
                         'tokenSeparators' => [',', ' '],
                         'maximumInputLength' => 10
                     ],
                     'data'=> ArrayHelper::map(ObjectsRealestates::find()->all(),'classification_star','classification_star'),
//                     'value'=> $detailFilter->realEstates->property_type_id,
                 ])
//                     ->label(false);
                 ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'price_standard')->textInput() ?></div>
                 <div class="col-lg-1"><?= $form->field($detailFilter->realEstates, 'guest_review')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'user_id')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'object_id')->textInput() ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'seaview')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'babycot')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'breakfast')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'halfboard')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'fullboard')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'berth')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'jacuzzi')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'terrace')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'tv_satelite')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'wifi')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'internet_fast')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'internet')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'smoking')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'luxurious')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'air_conditioning')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'tv_lcd')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'wheelchair_accessible')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'near_beach')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'pets')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'near_country')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'near_city')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'in_city')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'in_country')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'swimming_pool')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'swimming_pool_indoor')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'swimming_pool_indoor_heated')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'swimming_pool_outdoor')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'swimming_pool_outdoor_heated')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'parking')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'sauna')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'gym')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'separate_kitchen')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'elevator')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'heating')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'towels')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'linen')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'for_couples')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'for_family')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'for_friends')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'for_large_groups')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'for_wedings')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>

                 <div class="col-lg-1"><?= $form->field($detailFilter->facilities, 'total_privacy')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?></div>


                 
                 

                 <div class="form-group">
                     <?= Html::submitButton('Find', ['class' => 'btn btn-success']) ?>
                 </div>

                 <?php ActiveForm::end(); ?>

             </div>
        </div>
    <div class="col-lg-4">
        <?php
        echo backend\models\GoogleMapsMyRent::widget([
            'userLocations' => UnitsHelper::getAdresses($search->search()->query, $pages),
            'googleMapsUrlOptions' => [
                'key' => 'AIzaSyAYaEEvPm1nqrXpSGf7BHMksqg7N6RjULk',
                'language' => Yii::$app->language,
                'version' => '3.1.18',
            ],
            'googleMapsOptions' => [
                'mapTypeId' => 'roadmap',
                 'center'=>'{lat: 62.323907, lng: -150.109291}',
                'tilt' => 45,
                'zoom' => 5,
            ],
        ]);
        ?>
    </div>
    </div>
</div>
<!--    Детальный фильтр конец -->
        <?php
        ActiveForm::end();
        Pjax::end();
        ?>
<div class="row">
    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>

<div class="row">
        <style>
            /*common*/
            #freezer-example { width: 100%; max-height: 1500px; overflow: hidden; margin: 0em auto; }
            #freezer-example .table th,#freezer-example .table td { white-space: nowrap; }
            #freezer-example .table th { outline: 0px solid crimson; }
            #freezer-example .table thead th { outline: 0px solid gold; }
            #freezer-example .table col { width: 60px; }
        </style>
<div id="freezer-example">
<table class="yielding table table-freeze-multi table-bordered table-hover table-condensed" id="yielding_table" data-cols-number="2" style="overflow: hidden; margin: 1em auto;">
    <colgroup>
        <col style="width: 30px; background-color: white"">
        <col style="width: 300px; background-color: white"">
        <col style="width: 50px; background-color: white"">
        <?php for ($i=0; $i<$days; $i++) {?>
            <col>
        <?php } ?>
    </colgroup>
    <thead>
        <tr>
            <th rowspan="3" style="width: 30px; !important  background-color: white">
                <?php echo Html::checkbox('all',false,['data-all'=>1,'value'=>0,'onClick'=>'selectAll(this)']);?>
            </th>
            <th rowspan="3" style="width: 300px; background-color: white">
                <h4>Apartment</h4>
            </th>
            <th rowspan="3" style="width: 40px; background-color: white">
                <h4 style="-webkit-writing-mode: vertical-rl; writing-mode:tb-rl;">Booked</h4>
            </th>
            <?php
            for ($i=0; $i<$days; $i++) {
                echo CalendarHelper::getTableHeaderMonth(date("Y-m-d", strtotime ($search->start) + $i*24*3600 ) );
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i=0; $i<$days; $i++) {
                echo CalendarHelper::getTableHeaderDay(date("Y-m-d", strtotime ($search->start) + $i*24*3600 ) );
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i=0; $i<$days; $i++) {
                echo CalendarHelper::getTableHeaderDate(date("Y-m-d", strtotime ($search->start) + $i*24*3600 ) );
            }
            ?>
        </tr>
    </thead>
    <tbody>
<?php
    foreach ($data as $id=>$object) {
         if ($object["load"]<=10) $classTr="danger";
            elseif ((($object["load"] >10 ) && ($object["load"]<=80))) $classTr="warning";
                 else $classTr="success";
    ?>
        <tr>
            <th rowspan="2" style="width: 30px; !important">
                <?= Html::checkbox('apartment-'.$id,false,['class'=>'filter','id'=>$id,'data-object_id'=>$id, 'data-object_name'=>$object["name"],'value'=>0, 'onclick'=>'addRemoveObject(this)']);?>
            </th>
            <?php if ($object['hole']==0) { ?>
        <th rowspan="2" style="width: 300px;">
                    <?= $object["name"] ?>
        </th>
            <?php } else { ?>
            <th class ="danger" rowspan="2" style="width: 300px;">
                <?= $object["name"] ?>
            </th>
            <?php }?>
        <th rowspan="2" style="width: 50px;">
                <?php if ($object["load"]<= 10) $class="label-danger";
                elseif ((($object["load"] > 10 ) && ($object["load"] <= 80))) $class="label-warning";
                else $class="label-success";
              ?>
                <span class="empty badge <?=$class?>" >
                    <?php echo $object["load"].'%';

                    ?>

                </span>
        </th>
<?php
        echo CalendarHelper::getRowForPrice($object, $days, strtotime ($search->start), $id);
   ?>
        </tr>
        <tr>
<?php
        echo CalendarHelper::getRowForMinStay($object, $days, strtotime ($search->start), $id);
?>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
    <div class="row">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>
        </div>
    </div>
</div>





