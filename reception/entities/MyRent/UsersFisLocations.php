<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_fis_locations".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $adress_name
 * @property string $adress_number
 * @property string $city_name
 * @property string $city_zip
 * @property string $work_time
 * @property string $certificate
 * @property string $certificate_name
 * @property int $certificate_size
 * @property string $certificate_password
 * @property string $fis_status
 * @property string $fis_message
 * @property string $fis_sys_status system flag Y = loc fis
 * @property string $fis_request
 * @property string $fis_response
 * @property string $server_link
 * @property string $status
 * @property int $request_time
 * @property string $enable disabel / enable
 * @property string $created
 * @property string $chandeg
 *
 * @property Users $user
 */
class UsersFisLocations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_fis_locations';
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
        * @param string $code//
        * @param string $name//
        * @param string $adress_name//
        * @param string $adress_number//
        * @param string $city_name//
        * @param string $city_zip//
        * @param string $work_time//
        * @param string $certificate//
        * @param string $certificate_name//
        * @param int $certificate_size//
        * @param string $certificate_password//
        * @param string $fis_status//
        * @param string $fis_message//
        * @param string $fis_sys_status// system flag Y = loc fis
        * @param string $fis_request//
        * @param string $fis_response//
        * @param string $server_link//
        * @param string $status//
        * @param int $request_time//
        * @param string $enable// disabel / enable
        * @param string $created//
        * @param string $chandeg//
        * @return UsersFisLocations    */
    public static function create($id, $user_id, $code, $name, $adress_name, $adress_number, $city_name, $city_zip, $work_time, $certificate, $certificate_name, $certificate_size, $certificate_password, $fis_status, $fis_message, $fis_sys_status, $fis_request, $fis_response, $server_link, $status, $request_time, $enable, $created, $chandeg): UsersFisLocations
    {
        $usersFisLocations = new static();
                $usersFisLocations->id = $id;
                $usersFisLocations->user_id = $user_id;
                $usersFisLocations->code = $code;
                $usersFisLocations->name = $name;
                $usersFisLocations->adress_name = $adress_name;
                $usersFisLocations->adress_number = $adress_number;
                $usersFisLocations->city_name = $city_name;
                $usersFisLocations->city_zip = $city_zip;
                $usersFisLocations->work_time = $work_time;
                $usersFisLocations->certificate = $certificate;
                $usersFisLocations->certificate_name = $certificate_name;
                $usersFisLocations->certificate_size = $certificate_size;
                $usersFisLocations->certificate_password = $certificate_password;
                $usersFisLocations->fis_status = $fis_status;
                $usersFisLocations->fis_message = $fis_message;
                $usersFisLocations->fis_sys_status = $fis_sys_status;
                $usersFisLocations->fis_request = $fis_request;
                $usersFisLocations->fis_response = $fis_response;
                $usersFisLocations->server_link = $server_link;
                $usersFisLocations->status = $status;
                $usersFisLocations->request_time = $request_time;
                $usersFisLocations->enable = $enable;
                $usersFisLocations->created = $created;
                $usersFisLocations->chandeg = $chandeg;
        
        return $usersFisLocations;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $adress_name//
            * @param string $adress_number//
            * @param string $city_name//
            * @param string $city_zip//
            * @param string $work_time//
            * @param string $certificate//
            * @param string $certificate_name//
            * @param int $certificate_size//
            * @param string $certificate_password//
            * @param string $fis_status//
            * @param string $fis_message//
            * @param string $fis_sys_status// system flag Y = loc fis
            * @param string $fis_request//
            * @param string $fis_response//
            * @param string $server_link//
            * @param string $status//
            * @param int $request_time//
            * @param string $enable// disabel / enable
            * @param string $created//
            * @param string $chandeg//
        * @return UsersFisLocations    */
    public function edit($id, $user_id, $code, $name, $adress_name, $adress_number, $city_name, $city_zip, $work_time, $certificate, $certificate_name, $certificate_size, $certificate_password, $fis_status, $fis_message, $fis_sys_status, $fis_request, $fis_response, $server_link, $status, $request_time, $enable, $created, $chandeg): UsersFisLocations
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
            $this->adress_name = $adress_name;
            $this->adress_number = $adress_number;
            $this->city_name = $city_name;
            $this->city_zip = $city_zip;
            $this->work_time = $work_time;
            $this->certificate = $certificate;
            $this->certificate_name = $certificate_name;
            $this->certificate_size = $certificate_size;
            $this->certificate_password = $certificate_password;
            $this->fis_status = $fis_status;
            $this->fis_message = $fis_message;
            $this->fis_sys_status = $fis_sys_status;
            $this->fis_request = $fis_request;
            $this->fis_response = $fis_response;
            $this->server_link = $server_link;
            $this->status = $status;
            $this->request_time = $request_time;
            $this->enable = $enable;
            $this->created = $created;
            $this->chandeg = $chandeg;
    
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'adress_name' => Yii::t('app', 'Adress Name'),
            'adress_number' => Yii::t('app', 'Adress Number'),
            'city_name' => Yii::t('app', 'City Name'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'work_time' => Yii::t('app', 'Work Time'),
            'certificate' => Yii::t('app', 'Certificate'),
            'certificate_name' => Yii::t('app', 'Certificate Name'),
            'certificate_size' => Yii::t('app', 'Certificate Size'),
            'certificate_password' => Yii::t('app', 'Certificate Password'),
            'fis_status' => Yii::t('app', 'Fis Status'),
            'fis_message' => Yii::t('app', 'Fis Message'),
            'fis_sys_status' => Yii::t('app', 'Fis Sys Status'),
            'fis_request' => Yii::t('app', 'Fis Request'),
            'fis_response' => Yii::t('app', 'Fis Response'),
            'server_link' => Yii::t('app', 'Server Link'),
            'status' => Yii::t('app', 'Status'),
            'request_time' => Yii::t('app', 'Request Time'),
            'enable' => Yii::t('app', 'Enable'),
            'created' => Yii::t('app', 'Created'),
            'chandeg' => Yii::t('app', 'Chandeg'),
        ];
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
     * @return \reception\entities\MyRent\queries\UsersFisLocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersFisLocationsQuery(get_called_class());
    }
}
