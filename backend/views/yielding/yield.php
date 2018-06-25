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
    <div class="row" style="margin-top: 0px;">
        <div class = "col-lg-6">
            <?php  echo $form->field($search, 'filterName')->widget(Select2 ::classname(), [
                'options' => ['placeholder' => 'Filter','multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 10
                ],
                'data'=> ArrayHelper::map(Filters::find()->orderBy(['sort'=>SORT_ASC])->all(),'id','name'),
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
    <div class="row" style="margin-top: -20px;">
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
            <?php ActiveForm::end();
            Pjax::end(); ?>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
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
<table class="yielding table table-freeze-multi table-bordered table-hover table-condensed" id="yielding_table" data-cols-number="2"  data-scroll-height="750" style="overflow: hidden; margin: 1em auto;">
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





