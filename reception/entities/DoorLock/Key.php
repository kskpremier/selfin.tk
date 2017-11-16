<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:22
 */

namespace reception\entities\DoorLock;

use backend\models\DOMOUPRAV;
use reception\entities\Booking\Booking;
use reception\entities\User\User;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\httpclient\Client;

/**
 * @property integer $id
 * @property String $type
 * @property integer $end_date
 * @property integer $start_date
 * @property String $key_status
 * @property String $remarks
 * @property String $last_update_date
 * @property int $booking_id
 * @property int $key_id
 * @property int $door_lock_id
 * @property int $apartment_id
 * @property int $user_id
 *
 * @property DoorLock $key
 * @property Booking $booking

 */
class Key extends ActiveRecord
{
    public $guest_id;

    public static function create( $start_date, $end_date, $type, $booking_id,
                                   $door_lock_id, $user_id, $remarks) :self
    {
        $key = new static();
        $key->start_date = ($start_date > time()+60*60) ? $start_date: time()+60*60; // понять формат в котором с формы приходит дата
        $key->end_date = $end_date;
        $key->type = $type;
        $key->booking_id = $booking_id;
        $key->door_lock_id = $door_lock_id;
        $key->user_id = $user_id;
        $key->remarks = $remarks;

        return $key;
    }

    public function edit( $start_date, $end_date, $type, $booking_id,
                          $door_lock_id, $user_id,$remarks, $last_update_date,$key_status,$key_id
                            )
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->type = $type;
        $this->booking_id = $booking_id;
        $this->door_lock_id = $door_lock_id;
        $this->user_id = $user_id;
        $this->last_update_date = $last_update_date;
        $this->remarks = $remarks;
        $this->key_status = $key_status;
        $this->key_id = $key_id;
    }


    public static function tableName(): string
    {
        return '{{%key}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['id' => 'door_lock_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function sendEKeyByLocal(){
        //тут надо сформировать запрос и послать его на наш сервер
        $client = $client = new Client(['baseUrl' => DOMOUPRAV::DOMOUPRAB_ABSOLUTE_URL_TO_SEND_EKEY,]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/json'])
            ->addHeaders(['Accept' => 'application/json'])
            ->addHeaders(['Authorization' => 'Bearer '.DOMOUPRAV::DOMOUPRAV_ADMIN_TOKEN])
            ->setData([
                'door_lock_id' => $this->door_lock_id,
                'booking_id'=> $this->booking_id,
                'guest_id' =>($this->guest_id),
                'type'=>$this->type,
                'start_date'=>($this->type == '2')?  '0' : strtotime($this->start_date),
                'end_date'=>($this->type == '2')?  '0' : strtotime( $this->end_date), //2 - это на период, надеюсь
                'email'=> 'doorlockuser1@domouprav.hr',//$this->guest->contact_email,
            ])
            ->send();
        if ($response->isOk) {
            // $this->e_key = $response->data['E-key'];
            return $response->data['id'];
        }
        else return false;
    }
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getUser()
//    {
//        return $this->hasOne(User::className(), ['id' => 'user_id']);
//    }
}