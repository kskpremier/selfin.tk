<?php
//namespace frontend\views\Calculator;

use yii\helpers\Html;


use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\views\Calculator\Calculator */
/* @var $modelForm frontend\views\Calculator\CalculatorForm */

$this->title = "Subscription";
$this->params['breadcrumbs'][] = ['label' => 'Calculation', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

setlocale(LC_MONETARY, 'de_DE');
$beds = ( $modelForm->numberSingleBed+ $modelForm->numberDoubleBed+$modelForm->numberKidsBed);

?>
<div class="subscription-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="box">
        <div class="box-header with-border"></div>
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            <table class="table table-sm">
                <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>Parameters from owner </th>
                    <th>Current Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Volume of booking, annually EUR</td>
                    <td><?= $form->field($modelForm, 'volumeOfBooking')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Square of living part apartment, in M2</td>
                    <td><?= $form->field($modelForm, 'square')->textInput()->label(false) ?></td>

                </tr>

                <tr>
                    <th scope="row">3</th>
                    <td>Number of beds (sleeping place)</td>
                    <td><?= $form->field($modelForm, 'beds')->hiddenInput()->label(false) ?>
                        <?= $form->field($modelForm, 'numberSingleBed')->textInput()->label("Single") ?>
                        <?= $form->field($modelForm, 'numberDoubleBed')->textInput()->label("Double") ?>
                        <?= $form->field($modelForm, 'numberKidsBed')->textInput()->label("Kids") ?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Average number of checkins (smenas)</td>
                    <td><?= $form->field($modelForm, 'numberOfCheckin')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Average Price per day, EUR</td>
                    <td><?= $form->field($modelForm, 'price')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Average days of staying (duration of smenas)</td>
                    <td><?= $form->field($modelForm, 'durationOfStaying')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Services</td>
                    <td><?= $form->field($modelForm, 'multichannel')->checkbox() ?>
                    <?= $form->field($modelForm, 'yielding')->checkbox() ?>
                    <?= $form->field($modelForm, 'reception')->checkbox() ?>
                    <?= $form->field($modelForm, 'houseKeeping')->checkbox() ?>
                    <?= $form->field($modelForm, 'linen')->checkbox() ?>
                    <?= $form->field($modelForm, 'handyMan')->checkbox() ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="form-group">
            <?= Html::submitButton( 'Recalculate', ['btn btn-primary']) ?>
        </div>
        <div class="box-body">
            <table class="table table-hover table-inverse table-bordered">
                <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>Subscription items </th>
                    <th>Price for owner, %</th>
                    <th>Price for owner, EUR</th>
                    <th>Market price, EUR</th>
                    <th>Rona expenses, EUR</th>
                    <th>Rona margin, EUR</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Multichannel <?= Html::a('chart',["site/chart",'name'=>'Multichannel'],['class'=>"glyphicon glyphicon-stats"]) ?></td>
                    <td><?= number_format ($model->percentageRateForMultichannel*$modelForm->multichannel,2)?></td>
                    <td><?=number_format ($price = $model->percentageRateForMultichannel*$modelForm->volumeOfBooking/100*$modelForm->multichannel,2)?></td>
                    <td><?=number_format ($model->marketPriceForMultichannel*12,2)?></td>
                    <td><?=number_format ($expense =$model->expensesForMultichannel*12*$modelForm->multichannel,2) ?></td>
                    <td><?= number_format ($price-$expense*$modelForm->multichannel,2)?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Yielding <?= Html::a('chart',["site/chart",'name'=>'Yielding'],['class'=>"glyphicon glyphicon-stats"]) ?></td>
                    <td><?=number_format ($model->percentageRateForYielding*$modelForm->yielding,2)?></td>
                    <td><?=number_format ($price = $model->percentageRateForYielding*$modelForm->volumeOfBooking/100*$modelForm->yielding,2)?></td>
                    <td><?=number_format ($model->marketPriceForYielding*12,2)?></td>
                    <td><?=number_format ($expense =$model->expensesForYielding*12*$modelForm->yielding,2) ?></td>
                    <td><?= number_format ($price-$expense*$modelForm->yielding,2)?></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>House keeping <?= Html::a('chart',["site/chart",'name'=>'Housekeeping','square'=>$modelForm->square],['class'=>"glyphicon glyphicon-stats"]) ?></td>
                    <td><?= number_format ($model->percentageRateForHousekeeping*$modelForm->houseKeeping,2)?></td>
                    <td><?=number_format ($price = $model->percentageRateForHousekeeping*$modelForm->volumeOfBooking/100*$modelForm->houseKeeping,2)?></td>
                    <td><?=number_format ($model->marketPriceForHousekeeping * $modelForm->numberOfCheckin,2)?></td>
                    <td><?=number_format ($expense =$model->expensesForHousekeeping * $modelForm->numberOfCheckin*$modelForm->houseKeeping,2) ?></td>
                    <td><?= number_format ($price-$expense*$modelForm->houseKeeping,2)?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Linen</td>
                    <td><?= number_format ($model->percentageRateForLinen*$modelForm->linen,2)?></td>
                    <td><?=number_format ($price = $model->percentageRateForLinen*$modelForm->volumeOfBooking/100*$modelForm->linen,2)?></td>
                    <td><?=number_format ($model->marketPriceForLinen * $modelForm->numberOfCheckin *  $beds,2)?></td>
                    <td><?=number_format ($expense = $model->expensesForLinen * $modelForm->numberOfCheckin*$modelForm->linen,2) ?></td>
                    <td><?= number_format ($price-$expense*$modelForm->linen,2)?></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Handy man</td>
                    <td><?=number_format ($model->percentageRateForHandyman*$modelForm->handyMan,2)?></td>
                    <td><?=number_format ($price = $model->priceForHandyman*7*$modelForm->handyMan,2)?></td>
                    <td><?=number_format ($model->marketPriceForHandyman*7,2)?></td>
                    <td><?=number_format ($expense =$model->expensesForHandyman*7*$modelForm->handyMan,2)?></td>
                    <td><?=number_format ($price-$expense*$modelForm->handyMan,2)?></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Reception <?= Html::a('chart',["site/chart",'name'=>'Reception','volumeOfBooking'=>$modelForm->volumeOfBooking ,'beds'=>$beds],['class'=>"glyphicon glyphicon-stats"]) ?></td>
                    <td><?= number_format ($model->percentageRateForReception*$modelForm->reception,2)?></td>
                    <td><?=number_format ($price = $model->percentageRateForReception*$modelForm->volumeOfBooking/100*$modelForm->reception,2)?></td>
                    <td><?=number_format ($model->marketPriceForReception * $modelForm->numberOfCheckin*$beds,2)?></td>
                    <td><?=number_format ($expense =$model->expensesForReception * $modelForm->numberOfCheckin *$beds*$modelForm->reception,2) ?></td>
                    <td><?= number_format ($price-$expense*$modelForm->reception,2)?></td>
                </tr>
                </tbody>
                <thead class="thead-inverse">
                <tr>
                    <th>##</th>
                    <th>Total </th>
                    <th><?=number_format ($model->percentageTotal,2)?></th>
                    <th><?=number_format ($price = $model->TotalPrice,2)?></th>
                    <th><?=number_format ($model->TotalMarketPrice,2)?></th>
                    <th><?=number_format ($expense =$model->TotalRonaExpenses,2)?></th>
                    <th><?=number_format ($price-$expense,2)?></th>
                </tr>
                </thead>
            </table>

            <table class="table table-sm">
                <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>Manageble parameters </th>
                    <th>Current Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Rona expenses for MyRent for one apartment for 1 month, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesForMultichannel')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Rona expenses for  MyRent yielding for 1 apartment for 1 month, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesForYielding')->textInput()->label(false) ?></td>

                </tr>

                <tr>
                    <th scope="row">3</th>
                    <td>Rona expenses for 1 cleaning, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesForHousekeeping')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Rona expenses for 1 linen, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesLinenSingleBed')->textInput()->label("Single") ?>
                        <?= $form->field($modelForm, 'expensesLinenDoubleBed')->textInput()->label("Double") ?>
                        <?= $form->field($modelForm, 'expensesLinenKidsBed')->textInput()->label("Kids") ?></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Rona expenses for 1 visit of handy man, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesForHandyman')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Rona expenses for 1 guest registration with door lock, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesForReception')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Market price of multichannel, for 1 apartment monthly, EUR</td>
                    <td><?= $form->field($modelForm, 'marketPriceForMultichannel')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Market price of yielding, for 1 apartment for 1 month ,EUR </td>
                    <td><?= $form->field($modelForm, 'marketPriceForYielding')->textInput()->label(false) ?></td>

                </tr>

                <tr>
                    <th scope="row">3</th>
                    <td>Market price for 1 cleaning, EUR</td>
                    <td><?= $form->field($modelForm, 'marketPriceForHousekeeping')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Market price for 1 linen (for 1 sleeping place), EUR</td>
                    <td><?= $form->field($modelForm, 'marketPriceForLinen')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Market price for 1 handy man visit, EUR</td>
                    <td><?= $form->field($modelForm, 'expensesForHandyman')->textInput()->label(false) ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Market price for registration for 1 guest, EUR</td>
                    <td><?= $form->field($modelForm, 'marketPriceForReception')->textInput()->label(false) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>
