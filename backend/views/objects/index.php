<?php

use backend\helpers\AvailabilityHelper;
use backend\helpers\CalendarHelper;
use backend\models\Objects;
use backend\models\Rents;
use backend\models\RentsQuery;
use kartik\select2\Select2;
use kartik\typeahead\Typeahead;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\helpers\RentsHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<?php Pjax::begin(); ?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
        'id'=>'availability'
    ],
]); ?>
<div class="objects-index">


<?php
//сколько ячеек будет в календаре
    $days = (integer)((strtotime($searchModel->until) - strtotime($searchModel->start))/24/60/60);
    $days = ($days>=14 || $days==0)? 14: $days;
//поулчаем таблицу для календаря
    $availabilityList = AvailabilityHelper::getAvailability($dataProvider->query->orderBy(['objects.id' => SORT_ASC, 'rents.from_date' => SORT_ASC])->asArray()->all(),
    $searchModel->start, $searchModel->until);
//формируем некоторые заголовки
    $data = ArrayHelper::getColumn($availabilityList,'name');
    $data = (count($data))? $data:  ArrayHelper::getColumn(/*Objects::find()*/$dataProvider->query->select('objects.name')->all(),'name');
    $countObjects= count($availabilityList);
    $page=0;
    //пропорции между календарем и названиями
    $widthCalendar = 75;
    $widthName = 25;
    
    ?>
    <div class="panel panel-default" id="main_panel" style="position: relative; zoom: 1;">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="highlighted-tab1" style="margin-top: 15px;">
    <div  style="position: relative; width: 100%; overflow: auto; margig-bottom: 30px;">
        <table style="width: 100%; table-layout: fixed;  vertical-align: middle;" class="table-bordered table-hover table-togglable" id="table_rents_row">

            <thead>
            <tr >
                <th style="text-align: center;  min-width: 200px !important; background-color: white;" ">
                    <?= $form->field($searchModel,'reception')->dropDownList(RentsHelper::getReceptionList())->label(false)?></th>
                <th rowspan="1" colspan="<?=$days?>" style="width:<?=$widthCalendar?>%; text-align: center;">
                    <div class = 'row'>
                        <div class = "col-lg-4">
                            <?= $form->field($searchModel, 'start')->widget(DatePicker::className(), [
                                'model' => $searchModel,
                                'value' => $searchModel->start,
                                'attribute' => 'start',
                                'options' => ['placeholder' => $searchModel->start, "style"=>"z-index: 100;"],
                                'type' => DatePicker::TYPE_INPUT ,
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,]
                            ])->label(false);
                            ?>
                        </div>
                        <div class = "col-lg-4">

                            <?= $form->field($searchModel, 'until')->widget(DatePicker::className(), [
                                'model' => $searchModel,
                                'value' => $searchModel->until,
                                'attribute' => 'until',
                                'options' => ['placeholder' => 'To'],
                                'type' => DatePicker::TYPE_INPUT ,
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,]
                            ])->label(false);
                            ?>
                        </div>
                        <div class = "col-lg-4">
                            <div class="form-group">
                                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                            </div>
                        </div>
                    </div>
                </th>

            </tr>
            <tr>
                <th rowspan="1" style="width:<?=$widthName?>%; vertical-align: top; text-align: center; ">
                    <?php  echo $form->field($searchModel, 'property')->widget(Select2 ::classname(), [
                                        'options' => ['placeholder' => 'Property name...','multiple' => true],
                                        'pluginOptions' => [
                                            'tags' => true,
                                            'tokenSeparators' => [',', ' '],
                                            'maximumInputLength' => 10
                                        ],
                                        'data'=> ArrayHelper::map( RentsHelper::getApartments(), 'id','name'),
                                        'value'=> $searchModel->property,// ArrayHelper::map($doorLock->apartments,'id','name'),

                                    ])
                        ->label(false); ?>
                    <?php ActiveForm::end(); ?>
                </th>
                <?php for ($i=0;$i<$days;$i++) { ?>
                    <?= CalendarHelper::getTableHeader(date("Y-m-d", strtotime ($searchModel->start) + $i*24*60*60 ) )?>
<!--                    --><?php //echo '<th colspan="2" style="text-align: center; width:'.(integer)($widthCalendar/$days).'%;">'.date("d-M", strtotime($searchModel->start)+$i*24*60*60).'</th>'; ?>
                <?php  } ?>
            </tr>
            </thead>
            <tbody style="overflow: auto;">
            <?php
            //пока без пагинации первые 20 объектов
            $numberOfRow = min($countObjects, 20);
            for ($j=0; $j<$numberOfRow; $j++) {
                $object= $availabilityList[$j]; ?>

            <tr>
                <td style="text-align: right; padding-right: 5px; width: <?=$widthName?>%; !important;">
                    <div class="col-lg-10">
                    <span class="name">
                        <?= $object["name"] ?>
                    </span>
                    </div>
                    <div class="col-lg-2">
                        <?php if ($object["load"]<=10) $class="label-danger";
                                elseif ((($object["load"] >10 ) && ($object["load"]<=80))) $class="label-warning";
                                    else $class="label-success";


//                        $class= ($object["load"]<=10) ? "label-danger" : (($object["load"] >10 ) && ($object["load"]<=80)) ? "label-warning": "label-success"; ?>
                    <span class="empty badge <?=$class?>" >
                         <?php echo $object["load"].'%';?>
                    </span>
                    </div>
                </td>
                <?=CalendarHelper::getOneRow($object, $days, $searchModel->start, $widthCalendar/$days) ?>
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
