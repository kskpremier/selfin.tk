<?php

namespace backend\models;

use GuzzleHttp\Exception\ServerException;
use Yii;
use \backend\models\DOMOUPRAV;
use \api\models\TTL;
use yii\httpclient\Client;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property string $arrival_date
 * @property string $depature_date
 * @property integer $apartment_id
 * @property integer $number_of_tourist
 * @property integer $guest_id
 * @property string $external_id
 * @property string $first_name
 * @property string $second_name
 * @property string $contact_email
 * @property integer $status
 *
 * @property Apartment $apartment
 * @property Guest $guest
 */
class Booking extends \yii\db\ActiveRecord
{
    public $first_name;
    public $second_name;
    public $contact_email;
    public $external_id;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arrival_date', 'depature_date'], 'required'],
            [['first_name', 'second_name'], 'string', 'max'=>50],
            [['contact_email'],'email'],
            [['external_id'],'string', 'max'=>20],
            [['arrival_date', 'depature_date'], 'safe'],
            [['apartment_id', 'number_of_tourist', 'guest_id','status'], 'integer'],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(), 'targetAttribute' => ['apartment_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guest::className(), 'targetAttribute' => ['guest_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'arrival_date' => 'Arrival Date',
            'depature_date' => 'Depature Date',
            'apartment_id' => 'Apartment ID',
            'number_of_tourist' => 'Number Of Tourist',
            'guest_id' => 'Guest ID',
            'status'=>'Status'
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
    public function getGuests()
    {
        return $this->hasMany(Guest::className(), ['id' => 'guest_id'])->viaTable('{{%booking_guest}}', ['booking_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImage()
    {
        return $this->hasMany(PhotoImage::className(), ['booking_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeys()
    {
        return $this->hasMany(Key::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyboardPwds()
    {
        return $this->hasMany(KeyboardPwd::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }


    /*
     * Этот вызов будет дергать наш api контроллер
     * */

    public function createBookingLocal(){
        //тут надо сформировать запрос и послать его на китайский рестапи
        $client = $client = new Client([
            'baseUrl' => DOMOUPRAV::DOMOUPRAB_ABSOLUTE_URL_TO_CREATE_BOOKING,
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
                'apartment_id' => $this->apartment_id,
//                'booking_id'=> $this->id,
                'first_name' =>$this->first_name,
                'second_name'=>$this->second_name,
                'contact_email'=>$this->contact_email,
                'external_id'=>$this->external_id,
                'arrival_date'=>$this->arrival_date,
                'depature_date'=>$this->depature_date,
                'number_of_tourist'=> $this->number_of_tourist,
                'accessToken'=> DOMOUPRAV::DOMOUPRAV_ADMIN_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            // $this->e_key = $response->data['E-key'];
            return $response->data['id'];
        }
        else return false;
    }

    public function addNewBooking(){
    //создать нового User, предварительно проверив наличие такого юзера по почтовому ящику
        $user = \common\models\User::findByUserEmail($this->contact_email);
        if (!$user){
            $signUp = new \frontend\models\SignupForm();
            $signUp->email = $this->contact_email;
            $signUp->username = $this->second_name;
            $signUp->password = Yii::$app->security->generateRandomString(7);
            $user = $signUp->signup();
        }
        if (!$user){
            throw new ServerException('Can not add user with this name/email combination.');
        }
        $guest = \backend\models\Guest::find(['user_id'=>$user->id, 'first_name'=>$this->first_name, 'second_name'=>$this->second_name])->one();
        if ($guest){
            $guest = new \backend\models\Guest(['user_id'=>$user->id, 'first_name'=>$this->first_name,
                                                'second_name'=>$this->second_name, 'contact_email'=>$this->contact_email,
                                                'application_id'=>'1']); //заглушка
            $guest->save();
        }
        if (!$guest){
            throw new ServerException('Can not add guest with this name/email combination.');
        }
//        $booking = \backend\models\Booking::find(['external_id'=>$this->external_id,
//                                                   'arrival_date'=>$this->arrival_date,
//                                                  'depature_date'=>$this->depature_date,
//                                                    'apartment_id'=>$this->apartment_id]);
//
        $this->guest_id = $guest->id;
        //$this->sendLetterToUser($th);
        return ($this->save())? $this : null;
    }


    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'id'=>'id',
            'external_id' => 'external_id',
            'arrival_date'=>'arrival_date',
            'depature_date'=>'depature_date',
            'apartment_id' => 'apartment_id',
            'guest'=>'author',
//            'username'=>'author.user.username',
//            'initial_login'=>'author.user.login',
        ];
    }




}
