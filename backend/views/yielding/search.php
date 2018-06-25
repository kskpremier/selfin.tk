<?php

use backend\models\RentsAvailabilitySearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $detailFilterForm SearchForm */
/* @var $detailFilterForm DetailFilterForm */
/* @var $searchModel RentsAvailabilitySearch */

use kartik\checkbox\CheckboxX;
use kartik\date\DatePicker;
use kartik\slider\Slider;
use reception\forms\MyRent\DetailFilterForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use backend\models\ObjectsRealestates;
use reception\helpers\MyRentHelper;

$this->title = 'Search';

$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?= Html::encode("521 apartments in Croatia on Mar 22 - Apr 17 for 1 adult") ?></h1>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'action' => ['objects/search'],
                'method' => 'get' ,
                'options' => [
                    'data-pjax' => 3,
                    'id'=>'search-filter'
                 ],]) ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($detailFilterForm, 'location')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($detailFilterForm, 'from')->widget(DatePicker::className(), [
//                        'model' => $detailFilterForm,
//                        'attribute' => 'from',
                        'options' => ['placeholder' => 'Arrival date'],
                        'type' => DatePicker::TYPE_INPUT ,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,]
                    ]); ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($detailFilterForm, 'to')->widget(DatePicker::className(), [
//                        'model' => $detailFilterForm,
//                        'attribute' => 'to',
                        'options' => ['placeholder' => 'Departure date'],
                        'type' => DatePicker::TYPE_INPUT ,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,]
                    ]); ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($detailFilterForm, 'numberOfGuests')->dropDownList([1=>"1",2=>"2",3=>"3",4=>"4",5=>"4+",], ['prompt' => '']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($detailFilterForm, 'space')->textInput(['prompt' => 'm2']);//dropDownList([1=>"1",2=>"2",3=>"3",4=>"4",5=>"4+",], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
                <div class="col-md-6">
                    <?= Html::a('Clear', [''], ['class' => 'btn btn-default btn-lg btn-block']) ?>
                </div>
            </div>

<!--            --><?php //ActiveForm::end() ?>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-3 details-filter">
            <!--    Детальный фильтр старт-->
            <div class="row" id="details-filter">
                <div class="row">
                    <div class="col-lg-11">
                        <h1>Filter By:</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-11">
                        <h3>Price</h3>
                        <?php echo

                            '<b class="badge">&#x20ac;25</b> ' . Slider::widget([
                                'name'=>'DetailFilterForm[priceRange]',
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
                    <div class="col-lg-11">
                        <h3>Stars</h3>
                        <?php
                        $list = [5 => '5 Stars', 4 => '4 Stars',3 => '3 Stars',2 => '5 Stars',2 => '2 Stars',1 => '1 Stars'];
                        echo
                        $form->field($detailFilterForm, 'stars')->checkboxList($list);
                        ?>
                    </div>
                </div>

                <div class="row"  >
                    <div class="col-lg-11">
                        <h3>Facility</h3>
                        <?php
                        $list = ["Y" => 'Y', "N" => 'N'];
                        foreach ($detailFilterForm->facilities->attributes as $key=>$attribute):
                            echo  $form->field($detailFilterForm->facilities, $key)->checkbox()->label($key);//->widget (CheckboxX::className(),['data'=>$list]);
                        endforeach; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-11">
                        <h3>Room Facility</h3>
                        <?php
                        //            $list = ["Y" => 'Y', "N" => 'N'];
                        foreach ($detailFilterForm->values as $key=>$value): ?>
                        <div class="row">
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

                <?php ActiveForm::end(); ?>
            </div>

    </div>
    <div class="col-lg-9">
                <?= $this->render('/yielding/_list', [
                    'dataProvider' => $dataProvider,
                ]) ?>
    </div>
</div>

