<?php

namespace backend\models\query;
use api\models\TTL;
use function array_merge;
use function array_values;
use function is_string;
use reception\entities\Apartment\Apartment;
use reception\entities\Booking\Booking;
use reception\entities\DoorLock\DoorLock;
use reception\entities\DoorLock\Key;
use reception\entities\User\User;
use reception\helpers\TTLHelper;
use reception\services\TTL\TTL_TYPES;
use yii\helpers\ArrayHelper;


/**
 * This is the ActiveQuery class for [[Objects]].
 *
 * @see Objects
 */
class KeyboardPwdQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return Objects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Objects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return Objects|array|null
     */
    public function forUser($userIds)
    {
        if ($userIds) {
            $apartments = Apartment::find()->select('apartment.id, door_lock.id as doorLockId, apartment.user_id')->joinWith('doorLocks')->where(['apartment.user_id' => $userIds])->asArray()->all();
            foreach ( $apartments as $apart) {
                if ($apart['doorLockId'])
                    $doorLockIds[] = $apart['doorLockId'];
            }
            $doorLockIds = array_merge($doorLockIds, ArrayHelper::getColumn(DoorLock::find()->select('user_id, door_lock.id as doorLockId')->where(['user_id'=>$userIds])->asArray()->all(), 'doorLockId')); //замки где юзер числится владельцем замка
            $ids = array_values($doorLockIds);
        }

        return ($userIds)? $this->andWhere(['door_lock.id'=>$ids]) : $this->andWhere('1=1');
    }


    
    public function forPeriod($start,$until)
    {
        if (is_string($start))
            $start = strtotime($start);
        if (is_string($until))
            $until = strtotime($until);
        
        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'keyboard_pwd.start_date', $start], ['>',  'keyboard_pwd.end_date', $until] ],
            ['and', ['>=', 'keyboard_pwd.start_date', $start], ['<=', 'keyboard_pwd.end_date', $until] ],
            ['and', ['<',  'keyboard_pwd.start_date', $start], ['<',  'keyboard_pwd.end_date', $until],['>=', 'keyboard_pwd.start_date',  $start] ],
            ['and', ['<',  'keyboard_pwd.start_date', $start], ['>',  'keyboard_pwd.end_date', $until],['<=', 'keyboard_pwd.end_date', $until] ]
        ]);
    }
    
    public function isValid(){
        $query = $this->forPeriod(time(), time()+60*60*24*3)->andFilterWhere(['keyboard_pwd.keyboard_pwd_type'=>TTLHelper::TTL_KEYBOARD_PERIOD_TYPE]);
        $query = $query->orFilterWhere(['keyboard_pwd.keyboard_pwd_type'=>TTLHelper::TTL_KEYBOARD_PERMANENT_TYPE]);

        return $query;
    }

    public function inPeriod($start,$until){
        if (is_string($start))
            $start = strtotime($start);
        if (is_string($until))
            $until = strtotime($until);

        return $this->andFilterWhere(['and', ['>=',  'keyboard_pwd.start_date', $start], ['<=',  'keyboard_pwd.end_date', $until] ]);
    }

    public function isValidForKey(Key $key){

        $query = $this->joinWith('doorLock.keys')->andFilterWhere(['and',
            ['>=',  'keyboard_pwd.start_date', $key->start_date], ['<=',  'keyboard_pwd.end_date', $key->end_date] ,
            ['key.type'=>TTLHelper::TTL_KEY_PERIOD_TYPE]]);

        $query = $query->andFilterWhere(['and',['>=',  'keyboard_pwd.start_date',0], ['<=',  'keyboard_pwd.end_date',9999999999],['key.type'=>2]]);

        return $query;
    }


    public function isValidForBooking(Booking $booking){
            $start = strtotime($booking->start_date);
            $until = strtotime($booking->end_date);
       return $this->forPeriod($start,$until)->andFilterWhere(['keyboard_pwd.keyboard_pwd_type'=>TTLHelper::TTL_KEYBOARD_PERIOD_TYPE ]);
    }

    public function isValidForTourist (User $user) {
        $query = $this;
        if (isset($user->guest) ) {
            if (isset ($user->guest->bookings)) {
                foreach ($user->guest->bookings as $booking) {
                    $query = $query->isValidForBooking($booking);
                }
            }
            if (isset($user->guest->authorBookings)){
                foreach ($user->guest->authorBookings as $booking) {
                    $query = $query->isValidForBooking($booking);
                }
            }
        }
        return $query;
    }

    public function forLockUser (User $user) {
        $query=$this;
        if (count($user->keys)){
            foreach ($user->keys as $key) {
                $id = $key->door_lock_id;
                $start_date = ($key->start_date) ? $key->start_date : 0;
                $end_date = ($key->end_date) ? $key->end_date : 5537531200;
                $query = $this->andFilterWhere(['and', ['keyboard_pwd.door_lock_id' => $id], ['>=', 'keyboard_pwd.start_date', $start_date], ['<=', 'keyboard_pwd.end_date', $end_date],
                    ["!=", 'keyboard_pwd.end_date', 0]]);
            }
         } else {
            $query->forUser($user);
        }
        return $query;
    }


    public function isValidForUser(User $user) {
        $query = $this;
        foreach ($user->keys as  $key) {
            $query = $query->andFilterWhere(['keyboard_pwd.door_lock_id'=>$key->door_lock_id])->isValidForKey($key);

        }
        return $query;
    }

    public function forOwner(User $user){
        $doorLockIds=[];
        if ($user) {
            $apartments = Apartment::find()->select('apartment.id, door_lock.id as doorLockId, apartment.user_id')->joinWith('doorLocks')->where(['apartment.owner_id' => $user->id])->asArray()->all();
            foreach ( $apartments as $apart) {
                if ($apart['doorLockId'])
                    $doorLockIds[] = $apart['doorLockId'];
            }
            $doorLockIds = array_merge($doorLockIds, ArrayHelper::getColumn(DoorLock::find()->select('user_id, door_lock.id as doorLockId')->where(['user_id'=>$user->id])->asArray()->all(), 'doorLockId')); //замки где юзер числится владельцем замка
            $ids = array_values($doorLockIds);
        }

        return ($user)? $this->andWhere(['door_lock.id'=>$ids]) : $this->andWhere('1=1');
    }


}