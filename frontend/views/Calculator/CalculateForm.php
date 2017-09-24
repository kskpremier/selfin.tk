<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:33
 */


namespace frontend\views\Calculator;

//use reception\entities\Booking\Guest;
//use reception\entities\User\User;
//use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * @property 
 * 
 * @property double  $square
* @property double  $square_balcon
* @property double  $beds
* @property double  $price
* @property double  $multichannel
* @property double  $yielding
* @property double  $reception
* @property double  $houseKeeping
* @property double  $linen
* @property double  $handyMan
* @property double  $volumeOfBooking
* @property double  $numberOfCheckin
* @property double  $durationOfStaying
* @property  double $expensesForYielding
* @property  double $expensesForMultichannel
* @property  double $expensesForLinen
* @property  double $expensesForHandyman
* @property  double $expensesForReception
* @property  double $expensesForHousekeeping
* @property  double $marketPriceForYielding
* @property  double $marketPriceForMultichannel 
* @property  double $marketPriceForHousekeeping 
* @property  double $marketPriceForLinen
* @property  double $marketPriceForHandyman
* @property integer $numberSingleBed
* @property integer $numberDoubleBed
* @property integer $numberKidsBed
* @property double $numberVisitOfHandyMan
* @property double $expensesLinenSingleBed
* @property double $expensesLinenDoubleBed
* @property double $expensesLinenKidsBed

* @property  double $marketPriceForReception
 * 
 * 
 */
class CalculateForm extends Model
{
    public $square;
    public $square_balcon;
    public $price;
    public $multichannel;
    public $yielding;
    public $reception;
    public $houseKeeping;
    public $linen;
    public $handyMan;
    public $volumeOfBooking;
    public $numberOfCheckin;
    public $durationOfStaying;
    public $numberSingleBed;
    public $numberDoubleBed;
    public $numberKidsBed;

    public $beds; // = $numberSingleBed + $numberDoubleBed + $numberKidsBed;
    
    //manageble parameters

    public $expensesForYielding = 1.0; // for one apartment for 1 month
    public $expensesForMultichannel = 5.0; // for 1 apartment for 1 month
    public $expensesForLinen = 2.3; // for 1 bed
    public $expensesForHandyman = 10.0; // for 1 visit
    public $expensesForReception = 1.0; // for 1 guest registration
    public $expensesForHousekeeping = 11.0; // for 1 cleaning
    public $marketPriceForYielding = 10;  // for 1 year
    public $marketPriceForMultichannel = 8.0; // for 1 apartments for 1 month
    public $marketPriceForHousekeeping = 25.0; // for 1 cleaning
    public $marketPriceForLinen = 7.8; // for 1 bed
    public $marketPriceForHandyman = 20.0; // for 1 visit
    public $marketPriceForReception = 3.6; // for 1 guest
    public $numberVisitOfHandyMan = 7; //by default 7
    public $expensesLinenSingleBed = 2.3;
    public $expensesLinenDoubleBed = 2.3;
    public $expensesLinenKidsBed = 2.3;


    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->beds = $this->numberSingleBed + $this->numberDoubleBed + $this->numberKidsBed;
    }

    public function rules(): array
    {
        $this->beds = $this->numberSingleBed + $this->numberDoubleBed + $this->numberKidsBed;
        return [
            [[ 'square','square_balcon','price','volumeOfBooking','durationOfStaying','numberOfCheckin','numberVisitOfHandyMan','expensesLinenSingleBed','expensesLinenDoubleBed',
                'expensesLinenKidsBed',
           'expensesForYielding','expensesForMultichannel','expensesForLinen','expensesForHandyman','expensesForReception','expensesForHousekeeping','marketPriceForYielding',
                'marketPriceForMultichannel','marketPriceForHousekeeping','marketPriceForLinen','marketPriceForHandyman','marketPriceForReception'],'double'],
            [['beds', 'numberSingleBed', 'numberDoubleBed', 'numberKidsBed'],'integer'],
            [[ 'multichannel', 'yielding', 'reception', 'houseKeeping', 'linen', 'handyMan'],'safe']
        ];
    }

}