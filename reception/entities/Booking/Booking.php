<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 10:54
 */

namespace reception\entities\Booking;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\Key;
use reception\entities\DoorLock\KeyboardPwd;
use backend\models\BookingGuest;
use reception\entities\User\User;
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
 * @property integer $booking_id
 * @property integer $status

 * @property Apartment $apartment
 * @property Guest $author
 * @property KeyboardPwd [] $keyboardPwds
 */
class Booking extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE=10;
    public const STATUS_CANCELLED=20;
    public const STATUS_NONE=0;

    public static function create( $startDate,$endDate,$apartment,$author=null,$numberOfGuest,$externalId,$status,$guests=null) :self
    {
        $booking = self::find()->where([
            'start_date' =>$startDate,
            'end_date' =>$endDate,
            'external_id' =>$externalId,
            'status' =>$status
            ])->one();
        if ( !isset($booking) ) {
            $booking = new static();
            $booking->start_date = $startDate;
            $booking->end_date = $endDate;
            $booking->external_id = $externalId;
            $booking->number_of_tourist = $numberOfGuest;
            $booking->status = $status;
        }
        $booking->number_of_tourist = $numberOfGuest;
        if (isset($author))
            $booking->author = $author;
        if (isset($guests))
            $booking->guests = $guests;
        $booking->apartment = $apartment;
        return $booking;
    }

    public function edit( $first_name,$second_name,$contact_email, $application_id, $user_id, $document_id)
    {

        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->contact_email = $contact_email;
        $this->application_id = $application_id;
        $this->user_id = $user_id;
        $this->document_id = $document_id;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
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


    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'booking_id'=>'id',
            'external_booking_id' => 'external_id',
            'start_date'=>function (){
                             return date ("Y-m-d H:i", strtotime($this->start_date));
                            },
            'end_date'=>function (){return date ("Y-m-d H:i", strtotime( $this->end_date));},
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
                'relations' => ['author','guests','apartment'],
            ],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email,$password=null)
    {
        $booking = $this;
        //Костыль - пока не знаю как поступить с человекочитаемым паролем
        //Проблема будет в том, что наше письмо будет конфликтовать с тем, которое посылает MyRent
        //Перезатирается пароль
        $this->temporary_password = (isset($password))? $password : $booking->author->user->getNewReadablePassword();

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(["info@domouprav.hr"=>'Rona mReception'])
            ->setSubject('Booking informantion - door lock password key')
            ->setTextBody('Dear guest, thank you for using our booking service.'.PHP_EOL.'You booking for apartment - '.
                $booking->apartment->name.' - is confirmed.'.PHP_EOL.' Period of living from '.$booking->start_date.
                ' to '.$booking->end_date.PHP_EOL.'For opening the door you can use our Rona Mobile Application (for Android platform only). You can download it from http://domouprav.hr/mReception.apk .'.
                PHP_EOL.'Please use this login/password for first login to . '.PHP_EOL.' Login : '.
                $booking->author->second_name.' '.PHP_EOL.'Password : '.$this->temporary_password.PHP_EOL.
                'Please, don\'t forget change this password when you make your first login.'.PHP_EOL.
                ' You can use Rona Mobile Application for opening door, self-registration, ordering services and getting some useful touristic information.'.
                PHP_EOL.'If you don\'t have Android platform smartphone - just use  digital keyboard password for opening the door :'.$booking->getKeyboardPwds()->one()->value )
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

    public static function findByBookingIdentity($identity){
        return Booking::find()->where(['external_id'=>$identity])->orWhere(['id'=>$identity])->one();
    }


}
