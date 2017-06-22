<?php

namespace backend\models;

use GuzzleHttp\Exception\ServerException;
use Yii;

/**
 * This is the model class for table "door_lock".
 *
 * @property integer $id
 * @property integer $admin_pwd
 * @property string $type
 * @property integer $apartment_id
 * @property integer $lock_id
 * @property string $lock_mac
 * @property string $lock-alias
 * @property string $lock_name
 * @property integer $electric_quantity
 * @property string $last_update_date
 * @property $flag_pos integer
 * @property $lock_version_id
 * @property $no_key_pwd string
 * @property $delete_pwd string
 * @property $pwd_info string
 * @property $timestamp string
 * @property $special_value integer
 * @property $timezone_raw_offset integer
 * @property $lock_special_value integer
 * @property string $lockVersionString JSON for model AR LockVersion
 *
 * @property integer $keyStatus;
 * @property integer $keyId;
 * @property string $lockKey;
 * @property integer $startDay;
 * @property string $remarks;
 * @property string $aesKeyStr;

 * @property Apartment $apartment
 * @property Key[] $keys
 * @property KeyboardPwd[] $keyboardPwds
 * @property LockVersion $lockVersion
 * @property Token[] $tokens
 */
class DoorLock extends \yii\db\ActiveRecord
{
      public $lockVersion;
        //for key parameters
      public $keyStatus;
      public $keyId;
      public $lockKey;
      public $startDay;
      public $remarks;
      public $aesKeyStr;
      public $lockVersionString;
        //for keyboard password parameters




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'door_lock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_pwd', 'lock_version_id','id'], 'integer'],
            [['type', 'lock_mac', 'lock-alias', 'lock_name'], 'string', 'max' => 255],
            [['lock_id'], 'integer'],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(), 'targetAttribute' => ['apartment_id' => 'id']],
            [['no_key_pwd', 'delete_pwd', 'pwd_info','admin_pwd'],'safe'],
            [['timestamp'],'safe'],
            [['last_update_date'],'safe'],
            [['special_value', 'timezone_raw_offset', 'flag_pos','electric_quantity'],'safe'],
            [['lockVersionString'],'safe'],
            [['startDay'],'safe'],
            [['keyStatus','keyId'],'safe'],
            [['aesKeyStr','lockKey'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lockId' => Yii::t('app', 'lockId'),
            'admin_pwd' => Yii::t('app', 'Admin Pin'),
            'type' => Yii::t('app', 'Type'),
            'apartment_id' => Yii::t('app', 'Apartment ID'),
            'lock_id' => Yii::t('app', 'Lock ID'),
            'lock_mac' => Yii::t('app', 'Lock Mac'),
            'lock-alias' => Yii::t('app', 'Lock Alias'),
            'lock_name' => Yii::t('app', 'Lock Name'),
            'electric_quantity' => Yii::t('app', 'Electric Quantity'),
            'flag_pos'=>Yii::t('app','Flag'),
            'aes_key_str'=>Yii::t('app','Encode'),
            'no_key_pwd'=>Yii::t('app','No key password'),
            'delete_pwd'=>Yii::t('app','Delete password'),
            'pwd_info'=>Yii::t('app','Password info'),
            'timestamp'=>Yii::t('app','Timestamp'),
            'special_value'=>Yii::t('app','Special value'),
            'timezone_raw_offset'=>Yii::t('app','Timezone offset'),
            'last_update_date'=>Yii::t('app','Last update'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartment()
    {
        return $this->hasOne(Apartment::className(), ['id' => 'apartment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['door_lock_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeys()
    {
        return $this->hasMany(Key::className(), ['door_lock_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLockVersion() {
        return $this->hasOne(LockVersion::className(), ['id' => 'lock_version_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyboardPwds()
    {
        return $this->hasMany(KeyboardPwd::className(), ['door_lock_id' => 'id']);
    }


    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'id' => 'id',
            'admin_pwd'=>'admin_pwd',
            'apartment_id'=>'apartment_id',
            'type' => 'type',
            'lock_id'=>'lock_id',
            'lock_mac' => 'lock_mac',
            'lock-alias' => 'lock-alias',
            'lock_name' => 'lock_name',
            'electric_quantity' => 'electric_quantity',
            'last_update_date' => 'last_update_date',
            'lock_version'=>'LockVersion'
        ];
    }
    /*
     * Этот вызов будет дергать наш api контроллер и добавлять замок
     * */

    public function initLocal(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => DOMOUPRAV::DOMOUPRAB_ABSOLUTE_URL_TO_CREATE_DOORLOCK,
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/json'])
            ->addHeaders(['Accept' => 'application/json'])
            ->addHeaders(['Authorization' => 'Bearer '.DOMOUPRAV::DOMOUPRAV_ADMIN_TOKEN])
            ->setData([
                "last_update_date" => time(),
                "date"=>time(),
                "lock_alias"=>"M201T_780566",
                "keyStatus"=>"110401",
                "endDay"=>0,
                "no_key_pwd"=>"5145746",
                "keyId"=>367238,
                "lock_mac"=>"C0:DE:EE:66:05:78",
                "delete_pwd"=>"",
                "timezone_raw_offset"=>7200000,
                "lock_id"=>50088,
                "electric_quantity"=>100,
                "admin_pwd"=>"NDEsNDQsNDYsMzIsMzMsMzIsNDQsNDEsNDcsNDUsMTAz",
                "lock_flag_pos"=>0,
                "aesKeyStr"=>"e9,cd,f5,21,b5,63,fc,c3,96,b7,16,fe,d6,16,41,b0",
                "lockVersionString"=> json_encode(["showAdminKbpwdFlag"=>true,
                                            "group_id"=>1,
                                            "protocol_version"=>3,
                                            "protocol_type"=>5,
                                            "org_id"=>1,
                                            "logo_url"=>"",
                                            "scene"=>2]),
                "user_type"=>"110301",
                "lockKey"=>"OCw5LDEyLDE1LDE1LDE0LDAsMTMsMTUsMTEsNzA=",
                "lock_name"=>"M201T_780566",
                "startDay"=>0,
                "remarks"=>"",
                'accessToken'=> DOMOUPRAV::DOMOUPRAV_ADMIN_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            // $this->e_key = $response->data['E-key'];
            return $response->data['id'];
        }
        else return false;
    }

    public function addNewDoorlock(){
        //создать новый lockversion или использовать имеющийся
         $lockVersion = \backend\models\LockVersion::addNewDoorLockVersion($this->lockVersionString);
         $this->lock_version_id = $lockVersion->id;
         $flag = $this->save();
         //создаем новый админский ключ
        if ($flag) {
            $adminKey = new \backend\models\Key ([
                'value' => $this->adminPwd,
                'key_id' => $this->keyId,
                'lock_key' => $this->lockKey,
                'start_date' => $this->startDay,
                'remarks' => $this->remarks,
                'aes_key_str' => $this->aesKeyStr,
                'door_lock_id' => $this->id,
            ]);
        }     else throw new ServerException('Can not create door lock with this parameters');
        if (    $flag = $flag && $adminKey->save() ) {

            return ($flag)? $this : null;
        }
        else throw new ServerException('Can not create an admin Key for Door lock with this parameters');
    }
}
