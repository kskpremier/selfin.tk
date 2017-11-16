<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 11/5/17
 * Time: 11:27 AM
 */

namespace reception\forms\MyRent;

use reception\forms\CompositeForm;
use reception\forms\MyRent\DoorLockForm;
//use yii\base\Model;

/**
 * @property string  $object_id
 * @property string  $guid
 * @property string  $object_code
 * @property string  $object_name
 * @property string  $name
 * @property string  $object_color
 * @property string  $city_name
 * @property string  $country
 * @property float   $latitude
 * @property float   $longitude
 * @property string  $adress
 * @property string  $unit_name
 * @property integer $owner_id
 * @property integer $worker_id
 * @property integer $user_id
 *
 * @property DoorLockForm $doorlocks
 
 */


class ApartmentForm extends CompositeForm
{
    public $object_id;
    public $guid;
    public $object_code;
    public $object_name;
    public $name;
    public $object_color;
    public $city_name;
    public $country;
    public $latitude;
    public $longitude;
    public $adress;
    public $owner_id;
    public $worker_id;
    public $user_id;

    /**
     * ApartmentsForm constructor.
     */
    public function __construct(array $config = [],array $rentInfo=null)
    {
        parent::__construct($config);
        if (isset($rentInfo) ){
            $this->load($rentInfo,'');
        }
        $this->doorlocks = [new DoorLockInstallForm()];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          
            [['guid','object_code','object_name','object_color','city_name','country','latitude','longitude','adress','name'], 'string'],
            [['object_id','user_id','owner_id','worker_id'], 'integer'],

        ];
    }
    protected function internalForms(): array
    {
        return ['doorlocks'];
    }

}