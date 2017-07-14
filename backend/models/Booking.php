<?php

namespace backend\models;


use yii\web\BadRequestHttpException;
use Yii;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\DoorLock\Key;
use reception\entities\DoorLock\KeyboardPwd;
use backend\models\BookingGuest;
use yii\httpclient\Client;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property string $external_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $apartment_id
 * @property string $external_apartment_id
 * @property integer $number_of_tourist
 * @property integer $guest_id

 * @property string $first_name
 * @property string $second_name
 * @property string $contact_email
 * @property integer $status
 * @property string $temporary_password
 * @property Apartment $apartment
 * @property Guest $author
 * @property KeyboardPwd [] $keyboardPwds
 */
class Booking extends \yii\db\ActiveRecord
{
    const STATUS_CANCELLED = 20;
    const STATUS_ACTIVE = 10;
    /**
     * @var
     */
    public $first_name;
    public $second_name;
    public $contact_email;
    public $temporary_password;
//    public $external_booking_id;
    public $external_apartment_id;


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
            [['start_date', 'end_date'], 'required'],
            [['first_name', 'second_name'], 'string', 'max'=>50],
            [['contact_email'],'email'],
            [['external_apartment_id','external_id'],'string', 'max'=>20],
            [['start_date', 'end_date'], 'string', 'max'=>100],
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
            'start_date' => 'Arrival Date',
            'end_date' => 'Depature Date',
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
    public function getPhotoImages()
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
            ->addHeaders(['accept' => 'application/json'])
            ->addHeaders(['Authorization' => 'Bearer '.DOMOUPRAV::DOMOUPRAV_TOKEN])
            ->setData([
                'external_apartment_id' => $this->apartment->external_id,
                'external_id'=> $this->external_id,
                'first_name' =>$this->first_name,
                'second_name'=>$this->second_name,
                'contact_email'=>$this->contact_email,
//                'external_booking_id'=>$this->external_id,
                'start_date'=>$this->start_date,
                'end_date'=>$this->end_date,
                'number_of_tourist'=> $this->number_of_tourist,
//                'accessToken'=> DOMOUPRAV::DOMOUPRAV_TOKEN
            ])
            ->send();
        if ($response->isOk) {
            // $this->e_key = $response->data['E-key'];
            return $response->data['id'];
        }
        else return false;
    }

    /**
     * Add new booking, guest, generate new user for App generate keyboardPwds return result
     * @param booling $doWeNeedToSendLetter - if == true after addind new booking letter wil be send to tourist
     * @return Booking|null
     */
    public function addNewBooking($doWeNeedToSendLetter=false){
        $flag = true;
        if (Booking::isUnique($this)) {

            $transaction = \Yii::$app->db->beginTransaction();
            try {

                //создать нового User, предварительно проверив наличие такого юзера по почтовому ящику
                $user = \common\models\User::findByUserEmail($this->contact_email);
                if (!$user) {
                    $signUp = new \frontend\models\SignupForm();
                    $signUp->email = $this->contact_email;
                    $signUp->username = $this->second_name;
                    $signUp->password = Yii::$app->security->generateRandomString(7);
                    $this->temporary_password=$signUp->password; //сохраним пароль
                    $user = $signUp->signup();
                }
                if (!$user) {
                    throw new BadRequestHttpException('Can not add user with this name/email combination.');
                }

                //Создать нового гостя, предварительно проверив, нет ли уже такого
                $guest = \backend\models\Guest::find()->andWhere(['first_name' => $this->first_name, 'second_name' => $this->second_name, 'contact_email' => $this->contact_email])->one();
                if ($guest === null) {
                    $guest = new \backend\models\Guest(['user_id' => $user->id, 'first_name' => $this->first_name,
                        'second_name' => $this->second_name, 'contact_email' => $this->contact_email,
                        'application_id' => '1']); //заглушка
                    $guest->save();
                }
                if (!$guest) {
                    throw new BadRequestHttpException('Can not add guest with this name/email combination.');
                }
                //Найти имеющиеся апартаменты
                if ($this->apartment_id) $apartment = Apartment::findOne(['apartment_id' => $this->apartment_id]);
                else $apartment = Apartment::findOne(['external_id' => $this->external_apartment_id]);
                if (!$apartment) {
                    throw new BadRequestHttpException('Can not find apartment with this identity.');
                }
                $this->apartment_id = $apartment->id;
                //установить статус букинга - активный
                $this->status = self::STATUS_ACTIVE;
                $this->guest_id = $guest->id;
                $flag = ($flag && $this->save());
                //добавить гостя в список гостей букинга
                $guestList = new BookingGuest(['booking_id'=>$this->id,'guest_id'=>$this->guest_id]);
                $flag = ($flag && $guestList->save());
                //Найти все замки, которые установлены в апартаментах
                //И сгенерировать первичный ключ на первые сутки
                foreach ($apartment->doorLocks as $doorLock) {
                    $keyboardPwd = new KeyboardPwd([
                        'door_lock_id' => $doorLock->id,
                        'booking_id' => $this->id,
                        'keyboard_pwd_version' => 4, //пока так, потом из модели $doorLock->keyboard_pwd_version,
                        'keyboard_pwd_type' => 3, //период
                        'start_date' => $this->start_date,
                        'end_date' => date('Y-m-d H:i:s', strtotime($this->start_date . " + 1 day")) //на 1 день
                    ]);
                    //получаем значение с китайского сервера для этого замка
                    $data = json_decode($keyboardPwd->getKeyboardPwdFromChina(), true);
                    //проверяем, что ответ корректен
                    if (!is_array($data) || !$data['success']) {
                        throw new BadRequestHttpException('Can not get keyboard password for this door lock identity: ' . $doorLock->id);
                    }
                }
                if ($doWeNeedToSendLetter) {
                    $this->sendEmail($this->contact_email); //котыль работать будет, но криво, надо бы сначала поставить в очередь, а затем после коммита транзакции уже отправлять клиенту
                }
                if ($flag) {
                    $transaction->commit();
                    return $this;
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            return null;
        }
        else  throw new BadRequestHttpException('Booking with the same ID, dates and apartment are already exist');
    }


    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'booking_id'=>'id',
            'external_booking_id' => 'external_id',
            'start_date'=>'start_date',
            'end_date'=>'end_date',
            'apartment_id'=>'apartment_id',
            'apartment_name'=>function (){return $this->apartment->name;},
            'external_apartment_id' => function (){return $this->apartment->external_id;},
//            'guest'=>'author',
//           'username'=>function(){ return $this->author->user->username;},
//            'initial_login'=>'author.user.login',
        ];
    }
    public function behaviors(): array
    {
        return [
         //   MetaBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['author','guests'],
            ],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $booking = $this;
        //Костыль - пока не знаю как поступить с человекочитаемым паролем
        //Проблема будет в том, что наше письмо будет конфликтовать с тем, которое посылает MyRent
        //Перезатирается пароль
        $this->temporary_password = $booking->author->user->getNewReadablePassword();

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(["info@domouprav.hr"=>'Rona mReception'])
            ->setSubject('Booking informantion - door lock password key')
            ->setTextBody('Dear guest, thank you for using our booking service.'.PHP_EOL.'You booking for apartment - '.$booking->apartment->name.' - is confirmed.'.PHP_EOL.' Period of living from '.$booking->start_date.' to '.$booking->end_date.PHP_EOL.'For opening the door you can use our Rona Mobile Application (for Android platform only). You can download it from http://domouprav.hr/mReception.apk .'.PHP_EOL.'Please use this login/password for first login to . '.PHP_EOL.' Login : '.$booking->author->first_name.' '.PHP_EOL.'Password : '.$this->temporary_password.PHP_EOL.'Please, don\'t forget change this password when you make your first login.'.PHP_EOL.' You can use Rona Mobile Application for opening door, self-registration, ordering services and getting some useful touristic information.'.PHP_EOL.'If you don\'t have Android platform smartphone - just use  digital keyboard password for opening the door :'.$booking->getKeyboardPwds()->one()->value )
            ->send();
    }

    public static function isUnique($booking){
        if (!$booking->apartment_id && $booking->external_apartment_id) {
            $apartment = Apartment::find()->andWhere(['external_id' => $booking->external_apartment_id])->one();
            if ($apartment) {
                return (Booking::find()->andWhere(['external_id' => $booking->external_id, 'start_date' => $booking->start_date, 'end_date' => $booking->end_date,
                    'apartment_id' => $apartment->id])->one()===null) ? true : false;
            }
        }
        return true;
    }


}
