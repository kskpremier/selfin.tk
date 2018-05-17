<?php

use backend\helpers\RentsHelper;
use backend\models\Filters;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\helpers\AvailabilityHelper;
use backend\helpers\CalendarHelper;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('/js/multifreezer.js');
?>
<div class="table-yielding">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

<!--    --><?php // echo $this->render('_search', ['model' => $objectDataProvider]); ?>
    <?php $form = ActiveForm::begin([
        'action' => ['superuser/yielding'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id'=>'availability'
        ],
    ]); ?>
    <div class="objects-index">


        <?php

        $countObjects= count($availabilityList);
        $page=0;
        //пропорции между календарем и названиями
        $widthCalendar = 75;
        $widthName = 25;

        ?>


<?php Pjax::begin(); ?>

<?php $form = ActiveForm::begin([
    'action' => ['superuser/yielding'],

    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
        'id'=>'availability'
    ],
]); ?>

<tr>
    <div class="col-lg-3" style="text-align: center;  min-width: 200px !important; background-color: white;">
        <?= $form->field($searchObjectModel,'reception')->dropDownList(RentsHelper::getReceptionList())->label(false)?>
    </div>
    <div  class="col-lg-3" style="text-align: center;">
                <?= $form->field($searchObjectModel, 'start')->widget(DatePicker::className(), [
                    'model' => $searchObjectModel,
                    'value' => $searchObjectModel->start,
                    'attribute' => 'start',
                    'options' => ['placeholder' => $searchObjectModel->start, "style"=>"z-index: 100;"],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])->label(false);
                ?>
    </div>
    <div class = "col-lg-3">
                <?= $form->field($searchObjectModel, 'until')->widget(DatePicker::className(), [
                    'model' => $searchObjectModel,
                    'value' => $searchObjectModel->until,
                    'attribute' => 'until',
                    'options' => ['placeholder' => 'To'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])->label(false);
                ?>
    </div>
    <div class = "col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
    </div>
</tr>

<tr>
    <div class = "col-lg-6">
    <?php  echo $form->field($searchObjectModel, 'property')->widget(Select2 ::classname(), [
        'options' => ['placeholder' => 'Property name...','multiple' => true],
        'pluginOptions' => [
                'allowClear' => true,
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
        'data'=> ArrayHelper::map($dataProvider->query->all(),'id','name'),//RentsHelper::getApartments(), 'id','name'),
        'value'=> ($searchObjectModel->property)?$searchObjectModel->property:null,

    ])->label(false);?>
    </div>
    <div class = "col-lg-2">
    <?php  echo $form->field($searchObjectModel, 'occupancy')->widget(Select2 ::classname(), [
        'options' => ['placeholder' => 'Occupancy','multiple' => false],
        'pluginOptions' => [
//            'tags' => true,
//            'tokenSeparators' => [',', ' '],
//            'maximumInputLength' => 10
        ],
        'data'=> [0,10,20,30,40,50,60,70,80,90,100],
        'value'=> $searchObjectModel->occupancy,

    ])
        ->label(false);?>
    </div>
    <div class = "col-lg-2">
        <?php  echo $form->field($searchObjectModel, 'filterName')->widget(Select2 ::classname(), [
            'options' => ['placeholder' => 'Filter','multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
            'data'=> ArrayHelper::map(Filters::find()->all(),'id','name'),
            'value'=> $searchObjectModel->filterName,

        ])
            ->label(false);?>
    </div>
</tr>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
<tr class="">
<!--    --><?php //Pjax::begin(); ?>
<!--    --><?php //$form = ActiveForm::begin([
//        'action' => ['superuser/filter'],
//        'id'=>'filter-form',
//        'method' => 'get',
//        'options' => [
//            'data-pjax' => 1,
//            'id'=>'availability'
//        ],
//    ]); ?>
<!--    <div class = "col-lg-3">-->
<!--        --><?php // echo $form->field($searchObjectModel, 'name')->textInput()->label('Filters')?>
<!--        --><?//= Html::submitButton('Save filter',[])?>
<!--    </div>-->
<!--    --><?php //ActiveForm::end(); ?>
<!--    --><?php //Pjax::end(); ?>
</tr>
        <style>
            /*common*/
            #freezer-example { width: 100%; max-height: 1500px; overflow: hidden; margin: 0em auto; }
            #freezer-example .table th,#freezer-example .table td { white-space: nowrap; }
            #freezer-example .table th { outline: 0px solid crimson; }
            #freezer-example .table thead th { outline: 0px solid gold; }
            #freezer-example .table col { width: 60px; }
        </style>
        <div id="freezer-example">
<table class="table table-condensed table-freeze-multi table-bordered table-hover"  data-cols-number="2" style="overflow: hidden; margin: 1em auto;">
    <colgroup>
        <col style="width: 300px; background-color: white"">
        <col style="width: 50px; background-color: white"">
        <?php for ($i=0; $i<$days; $i++) {?>
            <col>
        <?php } ?>
    </colgroup>
    <thead>
        <tr>
            <th rowspan="3" style="width: 300px; background-color: white">

            </th>
            <th rowspan="3" style="width: 50px; background-color: white">

            </th>
            <?php
            for ($i=0; $i<$days; $i++) {
                echo CalendarHelper::getTableHeaderMonth(date("Y-m-d", strtotime ($searchObjectModel->start) + $i*24*60*60 ) );
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i=0; $i<$days; $i++) {
                echo CalendarHelper::getTableHeaderDay(date("Y-m-d", strtotime ($searchObjectModel->start) + $i*24*60*60 ) );
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i=0; $i<$days; $i++) {
                echo CalendarHelper::getTableHeaderDate(date("Y-m-d", strtotime ($searchObjectModel->start) + $i*24*60*60 ) );
            }
            ?>
        </tr>
    </thead>
    <tbody>
<?php
    $numberOfRow = count($availabilityList);
    for ($j=0; $j < $numberOfRow; $j++) {
         $object= $availabilityList[$j];
         if ($object["load"]<=10) $classTr="danger";
            elseif ((($object["load"] >10 ) && ($object["load"]<=80))) $classTr="warning";
                 else $classTr="success";
    ?>
        <tr>
        <th style="width: 300px;">
                    <?= $object["name"] ?>
        </th>
        <th style="width: 50px;">
                <?php if ($object["load"]<=10) $class="label-danger";
                elseif ((($object["load"] >10 ) && ($object["load"]<=80))) $class="label-warning";
                else $class="label-success";
              ?>
                <span class="empty badge <?=$class?>" >
                    <?php echo $object["load"].'%';?>
                </span>
        </th>
<?php
    for ($i=0; $i<$days; $i++) {

        echo CalendarHelper::getSimpleRow($object, $days, strtotime ($searchObjectModel->start), $prices[$object['id']]);
    }
   ?>
        </tr>
    <?php } ?>
    </tbody>
</table>
                            </div>
                        </div>

                    </div>

            </div>
        </div>
    </div>


</div>


