<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 23.07.17
 * Time: 11:06
 */

/**
 * @property string $startDate
 * @property string $endDate
 * @property integer $startDateTimestamp
 * @property integer $endDateTimestamp
 */

namespace reception\forms;

use yii\base\Model;
use reception\forms\CompositeForm;

/**
 * @property LockVersionForm $lockVersion
 */
abstract class FormWithDates extends CompositeForm
{
    public $startDate;
    public $endDate;
    public $startDateTimestamp;
    public $endDateTimestamp;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->convertDates();
    }

    public function rules(): array
    {
        return [
            [['startDate', 'endDate'],'string', 'max' => 255],
            [['startDateTimestamp','endDateTimestamp'],'integer'],
            [['startDate'],'validateDates','message'=>'Start Date must be bigger then current time'],
            [['endDate'],'validateDates','message'=>'End Date must be bigger then Start Date'],
        ];
    }

    public function validateDates(){

//            if (strtotime($this->startDate) < (time()-60) ){
//                $this->addError('Start Date must be bigger then current time');
//            }
//            if (strtotime($this->endDate) < (time()) ){
//                $this->addError('Start Date must be bigger then current time');
//            }
//            if ((strtotime($this->endDate) < strtotime($this->startDate) )){
//                $this->addError( 'End Date must be bigger then Start Date');
//            }

    }
    public function load($data, $formName = null) : bool
    {
        $result = parent::load($data, $formName);
        $this->convertDates();
        return $result;
        // TODO: Change the autogenerated stub
    }

    private function convertDates(){
        if ($this->startDate && gettype($this->startDate)=='integer'){
            $this->startDate = date('Y-m-d H:i:s',$this->startDate/1000);
        }
        if ($this->endDate && gettype($this->endDate)=='integer'){
            $this->endDate = date('Y-m-d H:i:s',$this->endDate/1000);
        }

        if ($this->startDateTimestamp && gettype($this->startDateTimestamp)=='integer'){
            $this->startDate = date('Y-m-d H:i:s',$this->startDateTimestamp);
        }
        if ($this->endDateTimestamp && gettype($this->endDateTimestamp)=='integer'){
            $this->endDate = date('Y-m-d H:i:s', $this->endDateTimestamp);
        }
    }

    protected function internalForms(): array
    {
        return [];
    }
}