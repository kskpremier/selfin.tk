<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 11/5/17
 * Time: 11:22 AM
 */

namespace reception\forms\MyRent;

use reception\forms\CompositeForm;

/**
 * @property ApartmentForm[] $apartments;
 * @property integer  $id;
 *  @property integer $user_id
*  @property string  $guid
*  @property string  $name
*  @property integer $country_id
*  @property string  $tel
*  @property string  $email
*  @property string  $contact_name
*  @property string  $created
*  @property string  $changed
*  @property integer $language_id
*  @property string  $country
*  @property string  $name_local
*  @property integer $telephone_code
*

 */
class WorkerForm extends CompositeForm
{

    public $id;
    public $user_id;
    public $guid;
    public $name;
    public $country_id;
    public $tel;
    public $email;
    public $contact_name;
    public $created;
    public $changed;
    public $language_id;
    public $country;
    public $name_local;
    public $telephone_code;


    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->apartments = new ApartmentForm();
    }

    public function rules(): array
    {
        return [
            [[ 'guid','name','contact_name','created','changed','country','name_local','tel','email',],'string'],
            [['user_id','country_id','language_id','telephone_code'],'integer'],
            [['apartments'],'safe'],
            [['email'],'email'],
        ];
    }

    protected function internalForms(): array
    {
        return ['apartments','owners','workers'];
    }
}