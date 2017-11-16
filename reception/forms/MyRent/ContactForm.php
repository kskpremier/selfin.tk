<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 11/5/17
 * Time: 11:27 AM
 */

namespace reception\forms\MyRent;

use yii\base\Model;

/**
 * @property string $contact_name
 * @property string $contact_email
 * @property string $contact_tel
 * @property string $contact_country
 * @property string $contact_country_code1
 * @property string $first_name
 * @property string $second_name
 * @property string $country_id
 */


class ContactForm extends Model
{
    public $contact_name;
    public $contact_email;
    public $contact_tel;
    public $contact_country;
    public $contact_country_code1;
    public $guid;
    public $first_name;
    public $second_name;
    public $country_id;


    /**
     * ApartmentsForm constructor.
     */
    public function __construct(array $config = [],$rentInfo=null)
    {
        parent::__construct($config);
        if (isset($rentInfo) ){
            $this->load($rentInfo,'');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['contact_name', 'guid', 'contact_tel','contact_country','contact_country_code1','first_name','second_name','country_id'], 'string'],
            [['contact_email'],'string'],
//            [['object_id','user_id','owner_id','worker_id'], 'integer'],

        ];
    }

}