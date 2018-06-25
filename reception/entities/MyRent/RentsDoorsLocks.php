<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_doors_locks".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property int $b2b_id
 * @property string $apartment_id
 * @property string $external_apartment_id
 * @property string $username
 * @property string $password
 * @property string $keyboardPwd_id
 * @property string $door_lock_id
 * @property string $pin
 * @property string $start_date
 * @property string $end_date
 * @property string $keyboardPwd_type
 * @property string $request
 * @property string $response
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Rents $rent
 * @property Users $user
 */
class RentsDoorsLocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_doors_locks';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $user_id//
        * @param int $rent_id//
        * @param int $b2b_id//
        * @param string $apartment_id//
        * @param string $external_apartment_id//
        * @param string $username//
        * @param string $password//
        * @param string $keyboardPwd_id//
        * @param string $door_lock_id//
        * @param string $pin//
        * @param string $start_date//
        * @param string $end_date//
        * @param string $keyboardPwd_type//
        * @param string $request//
        * @param string $response//
        * @param string $created//
        * @param string $changed//
        * @return RentsDoorsLocks    */
    public static function create($id, $user_id, $rent_id, $b2b_id, $apartment_id, $external_apartment_id, $username, $password, $keyboardPwd_id, $door_lock_id, $pin, $start_date, $end_date, $keyboardPwd_type, $request, $response, $created, $changed): RentsDoorsLocks
    {
        $rentsDoorsLocks = new static();
                $rentsDoorsLocks->id = $id;
                $rentsDoorsLocks->user_id = $user_id;
                $rentsDoorsLocks->rent_id = $rent_id;
                $rentsDoorsLocks->b2b_id = $b2b_id;
                $rentsDoorsLocks->apartment_id = $apartment_id;
                $rentsDoorsLocks->external_apartment_id = $external_apartment_id;
                $rentsDoorsLocks->username = $username;
                $rentsDoorsLocks->password = $password;
                $rentsDoorsLocks->keyboardPwd_id = $keyboardPwd_id;
                $rentsDoorsLocks->door_lock_id = $door_lock_id;
                $rentsDoorsLocks->pin = $pin;
                $rentsDoorsLocks->start_date = $start_date;
                $rentsDoorsLocks->end_date = $end_date;
                $rentsDoorsLocks->keyboardPwd_type = $keyboardPwd_type;
                $rentsDoorsLocks->request = $request;
                $rentsDoorsLocks->response = $response;
                $rentsDoorsLocks->created = $created;
                $rentsDoorsLocks->changed = $changed;
        
        return $rentsDoorsLocks;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param int $b2b_id//
            * @param string $apartment_id//
            * @param string $external_apartment_id//
            * @param string $username//
            * @param string $password//
            * @param string $keyboardPwd_id//
            * @param string $door_lock_id//
            * @param string $pin//
            * @param string $start_date//
            * @param string $end_date//
            * @param string $keyboardPwd_type//
            * @param string $request//
            * @param string $response//
            * @param string $created//
            * @param string $changed//
        * @return RentsDoorsLocks    */
    public function edit($id, $user_id, $rent_id, $b2b_id, $apartment_id, $external_apartment_id, $username, $password, $keyboardPwd_id, $door_lock_id, $pin, $start_date, $end_date, $keyboardPwd_type, $request, $response, $created, $changed): RentsDoorsLocks
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->b2b_id = $b2b_id;
            $this->apartment_id = $apartment_id;
            $this->external_apartment_id = $external_apartment_id;
            $this->username = $username;
            $this->password = $password;
            $this->keyboardPwd_id = $keyboardPwd_id;
            $this->door_lock_id = $door_lock_id;
            $this->pin = $pin;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->keyboardPwd_type = $keyboardPwd_type;
            $this->request = $request;
            $this->response = $response;
            $this->created = $created;
            $this->changed = $changed;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'apartment_id' => Yii::t('app', 'Apartment ID'),
            'external_apartment_id' => Yii::t('app', 'External Apartment ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'keyboardPwd_id' => Yii::t('app', 'Keyboard Pwd ID'),
            'door_lock_id' => Yii::t('app', 'Door Lock ID'),
            'pin' => Yii::t('app', 'Pin'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'keyboardPwd_type' => Yii::t('app', 'Keyboard Pwd Type'),
            'request' => Yii::t('app', 'Request'),
            'response' => Yii::t('app', 'Response'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsDoorsLocksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsDoorsLocksQuery(get_called_class());
    }
}
