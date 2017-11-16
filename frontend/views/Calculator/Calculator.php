<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/11/17
 * Time: 2:24 PM
 */

/** *
 *
* @property  float $percentageRateForMultichannel
* @property  float  $percentageRateForYielding
* @property  float $percentageRateForHousekeeping
* @property  float $percentageRateForLinen
* @property  float $percentageRateForHandyman
* @property  float $percentageRateForReception


* @property  float $priceForMultichannel
* @property  float $priceForYielding
* @property  float $priceForHousekeeping
* @property  float $priceForLinen
* @property  float $priceForHandyman
* @property  float $priceForReception


* @property  float $expensesForYielding
* @property  float $expensesForMultichannel
* @property float $expensesForHousekeeping
* @property  float $expensesForLinen
* @property  float $expensesForHandyman
* @property  float $expensesForReception

* @property  float $marketPriceForYielding
* @property  float $marketPriceForMultichannel
* @property  float $marketPriceForHousekeeping
* @property  float $marketPriceForLinen
* @property  float $marketPriceForHandyman
* @property  float $marketPriceForReception

* @property  float $percentageTotal
* @property  float $TotalPrice
 
 
 */

namespace frontend\views\Calculator;

class Calculator extends \yii\base\Model
{
    const CURRENCY_EXCHANGE_RATE = 7.35;

    
    public $percentageRateForMultichannel;
    public $percentageRateForYielding;
    public $percentageRateForHousekeeping;
    public $percentageRateForLinen;
    public $percentageRateForHandyman;
    public $percentageRateForReception;
   

    public $priceForMultichannel;
    public $priceForYielding;
    public $priceForHousekeeping;
    public $priceForLinen;
    public $priceForHandyman;
    public $priceForReception;

    public $durationOfStaying;


    public $expensesForYielding;
    public $expensesForMultichannel;
    public $expensesForHousekeeping;
    public $expensesForLinen;
    public $expensesForHandyman;
    public $expensesForReception;
    
    public $marketPriceForYielding;
    public $marketPriceForMultichannel;
    public $marketPriceForHousekeeping;
    public $marketPriceForLinen;
    public $marketPriceForHandyman;
    public $marketPriceForReception;
    
    public $percentageTotal;
    public $TotalPrice;
    public $TotalMarketPrice;
    public $TotalRonaExpenses;
    public $TotalRonaMargin;


    public static function calculate(CalculateForm $form){

        $r = new static();
        $beds = $form->numberSingleBed + $form->numberDoubleBed + $form->numberKidsBed;

        $r->expensesForYielding = ($form->expensesForYielding)?$form->expensesForYielding: 1; // for one apartment for 1 month, EUR
        $r->expensesForMultichannel = ($form->expensesForMultichannel)?$form->expensesForMultichannel:5.0; // for 1 apartment for 1 month

        $r->expensesForHandyman = ($form->expensesForHandyman)?$form->expensesForHandyman:27.0; // for 1 visit
        $r->expensesForReception = ($form->expensesForReception)?$form->expensesForReception:1.2; // for 1 guest registration
        $r->expensesForHousekeeping = ($form->expensesForHousekeeping)?$form->expensesForHousekeeping:11.0; // for 1 cleaning
        $r->marketPriceForYielding = ($form->marketPriceForYielding)?$form->marketPriceForYielding: 120.0/12; // for one apartment for 1 month, EUR
        $r->marketPriceForMultichannel =($form->marketPriceForMultichannel)?$form->marketPriceForMultichannel: 8.0; // for 1 apartments for 1 month
        $r->marketPriceForHousekeeping = ($form->marketPriceForHousekeeping)?$form->marketPriceForHousekeeping:25.0; // for 1 cleaning
        $r->marketPriceForLinen = ($form->marketPriceForLinen)?$form->marketPriceForLinen:7.5; // for 1 bed
        $r->marketPriceForHandyman = ($form->marketPriceForHandyman)?$form->marketPriceForHandyman:20.0; // for 1 visit
        $r->marketPriceForReception = ($form->marketPriceForReception)?$form->marketPriceForReception:3.6; // for 1 guest



        $r->percentageRateForYielding = Calculator::calculatePercentageRateForYielding($form->volumeOfBooking);
        $r->percentageRateForMultichannel = Calculator::calculatePercentageRateForMultichanneling($form->volumeOfBooking);

        $r->priceForHousekeeping = Calculator::calculateEURSquareMPriceForCleaning($form->square)*$form->square; //price for 1 cleaning
        $r->percentageRateForHousekeeping = $r->priceForHousekeeping * $form->numberOfCheckin / $form->volumeOfBooking*100;

        $r->priceForLinen = Calculator::calculatePriceForOneLinen($form->numberOfCheckin, $form->numberDoubleBed, $form->numberSingleBed, $form->numberKidsBed, $form->volumeOfBooking);
        $r->percentageRateForLinen = $r->priceForLinen * $form->numberOfCheckin / $form->volumeOfBooking *100;
        $r->expensesForLinen = Calculator::calculateExpensesForOneLinen($form->numberDoubleBed, $form->numberSingleBed, $form->numberKidsBed,$form->expensesLinenSingleBed,$form->expensesLinenDoubleBed,$form->expensesLinenKidsBed);

        $r->priceForHandyman = Calculator::calculatePriceForOneHandyMan($form->numberOfCheckin,$beds,$form->volumeOfBooking);
        $r->percentageRateForHandyman = $r->priceForHandyman * 7 / $form->volumeOfBooking *100;

        $r->priceForReception = Calculator::calculatePriceForOneReception($form->numberOfCheckin,$beds,$form->volumeOfBooking); //price for 1 guest
        $r->percentageRateForReception = $r->priceForReception * $form->numberOfCheckin *$beds / $form->volumeOfBooking *100;
        
        $r->percentageTotal =   $r->percentageRateForMultichannel * $form->multichannel +
                                $r->percentageRateForYielding * $form->yielding +
                                $r->percentageRateForHandyman * $form->handyMan +
                                $r->percentageRateForHousekeeping * $form->houseKeeping +
                                $r->percentageRateForLinen * $form->linen +
                                $r->percentageRateForReception* $form->reception;
        $r->TotalPrice =  $form->volumeOfBooking * $r->percentageTotal/100;
        $r->TotalRonaExpenses = $r->expensesForMultichannel * $form->multichannel *12 +
                                $r->expensesForYielding * $form->yielding * 12 +
                                $r->expensesForHandyman * $form->handyMan  * $form->numberVisitOfHandyMan +
                                $r->expensesForHousekeeping * $form->houseKeeping *$form->numberOfCheckin +
                                $r->expensesForLinen * $form->linen * $form->numberOfCheckin +
                                $r->expensesForReception * $form->reception * $form->numberOfCheckin * $beds;
        $r->TotalRonaMargin = $r->TotalPrice - $r->TotalRonaExpenses;
        $r->TotalMarketPrice = $r->marketPriceForMultichannel * $form->multichannel *12 +
                                $r->marketPriceForYielding * $form->yielding *12 +
                                $r->marketPriceForHandyman * $form->handyMan * $form->numberVisitOfHandyMan +
                                $r->marketPriceForHousekeeping * $form->houseKeeping *$form->numberOfCheckin+
                                $r->marketPriceForLinen * $form->linen*$form->numberOfCheckin*$beds+
                                $r->marketPriceForReception* $form->reception * $form->numberOfCheckin * $beds;

        return $r;

    }

    public static function calculatePercentageRateForMultichanneling($volumeOfBooking){
        $result = (16903/4800 - 1.39*$volumeOfBooking/4800);
        if ($volumeOfBooking <= 2550)   $result=3.55;
            elseif ($volumeOfBooking > 2550 && $volumeOfBooking <= 4860)  $result = 12535.5/2310-1.69999999*$volumeOfBooking/2310;
                elseif ($volumeOfBooking > 4860 && $volumeOfBooking <= 8500)  $result = 10573.4/3640-0.79*$volumeOfBooking/3640;
                    elseif ($volumeOfBooking > 8500 && $volumeOfBooking <= 17500)  $result = 9964/6600-0.38*$volumeOfBooking/6600;
                        elseif ($volumeOfBooking > 17500) $result = 0.5;
        return $result;


    }

    public static function calculatePercentageRateForYielding($volumeOfBooking){

        $result = 0;
        if ($volumeOfBooking <= 2550)   $result = 3.5;
        elseif ($volumeOfBooking > 2550 && $volumeOfBooking <= 4860) $result =  (-1.7*$volumeOfBooking/2310+12420/2310);
            elseif ($volumeOfBooking > 4860 && $volumeOfBooking <= 6000) $result = (3510-0.3*$volumeOfBooking)/1140 ;
                 elseif ($volumeOfBooking > 6000 && $volumeOfBooking <= 8500) $result = (5249.99-0.3999*$volumeOfBooking)/1900 ;
                     elseif ($volumeOfBooking > 8500 && $volumeOfBooking <= 15800) $result = (12640-0.5*$volumeOfBooking)/7900;
                          elseif ($volumeOfBooking > 15800) $result = 0.6;
        return $result;

    }
    public static function calculatePercentageRateForHandyMan($volumeOfBooking){
        //$result =0;
        return 20;//;(19300/5500 - 1.5*$volumeOfBooking/5500);


    }
    public static function calculatePriceForOneHandyMan($numberOfCheckin, $beds, $volumeOfBooking){
        return 13.0;
    }
    public static function calculatePriceForOneLinen($numberOfCheckin, $double, $single, $kids, $volumeOfBooking)
    {
        $priceSingle = 3.0;
        $priceDouble = 3.0;
        $priceKids = 3.0;

        $priceForOneLinen = $priceSingle*$single + $priceDouble*$double + $kids*$priceKids;
        //$beds = $double+$single+$kids; // пока так
        return  $priceForOneLinen ;
        //return 3.0*$beds;//(19300/5500 - 1.5*$volumeOfBooking/5500)/100;

    }
    public static function calculateExpensesForOneLinen( $double, $single, $kids, $priceSingle,$priceDouble,$priceKids)
    {
        return $priceSingle*$single+$priceDouble*$double+$kids*$priceKids;
    }
    public static function calculatePriceForOneReception($numberOfCheckin, $beds, $volumeOfBooking)
    {
        return 3;
    }
    public static function calculatePercentageRateForReception($i,$volumeOfBooking,$beds)
    {
        $result = Calculator::calculatePriceForOneReception($i,$beds,$volumeOfBooking)*$i*$beds/$volumeOfBooking*100;
        return $result;
    }

    public static function calculateEURSquareMPriceForCleaning($square){

        //depends on numbers of check-in, square meters
        if ($square <=30){
            return 5/Calculator::CURRENCY_EXCHANGE_RATE;
        }

        elseif ($square <=100){
            return (46/20 - 0.19999*$square/20)/Calculator::CURRENCY_EXCHANGE_RATE;
        }

        return (1 + $square/300)/Calculator::CURRENCY_EXCHANGE_RATE;

    }
}