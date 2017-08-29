<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.07.17
 * Time: 13:22
 */

namespace reception\entities\DoorLock;

use reception\entities\User\User;
use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

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

    public static function create( $start_date, $end_date, $type, $booking_id,
                                   $door_lock_id, $user_id, $remarks) :self
    {
        $key = new static();
        $key->start_date = $start_date;
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
        return $this->hasOne(\backend\models\Booking::className(), ['id' => 'booking_id']);
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
}