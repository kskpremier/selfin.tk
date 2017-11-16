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
use reception\forms\MyRent\RentForm;
use yii\httpclient\Client;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property string $external_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $number_of_tourist
 * @property integer $booking_id
 * @property integer $status
 * @property string $guid
 * @property string $rent_status
 * @property string $from_time
 * @property string $until_time
 * @property float  $price
 * @property float  $exchange
 * @property string $label
 * @property string $price_local
 * @property string $paid
 * @property string $created
 * @property string $changed
 * @property integer $rent_adults
 * @property integer $rent_children
 * @property string $note
 * @property float  $in_advance
 * @property string $myrent_update
 * @property integer $apartment_id
 * @property integer $guest_id
 *
 * @property Apartment $apartment
 * @property Guest $author
 * @property Guest [] $guests
 * @property KeyboardPwd [] $keyboardPwds
 */
class Booking extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE=10;
    public const STATUS_CANCELLED=20;
    public const STATUS_NONE=0;
    public const STATUS_REGISTERED=30;
    public const STATUS_WARNING=40;
    public const STATUS_PAST=40;
    public const BOOKING_RECOCNITION_LOWREST_PROBABILITY = 0.9;

    public static function create( $startDate,$endDate,$apartment,$author=null,$numberOfGuest,$externalId,$status,$guests=null,
                                   $guid=null,$rent_status=null,$from_time=null,$until_time=null,$price=null,$exchange=null,
                                   $label=null,$price_local=null,$paid=null,$created=null,$changed=null) :self
    {
        $booking = self::find()->where([
//            'start_date' =>$startDate,
//            'end_date' =>$endDate,
            'external_id' =>$externalId,
            'guid' =>$guid
            ])->one();
        if ( !isset($booking) ) {
            $booking = new static();
            $booking->start_date = $startDate;
            $booking->end_date = $endDate;
            $booking->external_id = $externalId;
            $booking->number_of_tourist = $numberOfGuest;
            $booking->status = $status;
            $booking->guid= $guid;
            $booking->rent_status= $rent_status;
            $booking->from_time= $from_time;
            $booking->until_time= $until_time;
            $booking->price= $price;
            $booking->exchange= $exchange;
            $booking->label= $label;
            $booking->price_local= $price_local;
            $booking->paid= $paid;
            $booking->created= $created;
            $booking->changed= $changed;
            
        }
        $booking->number_of_tourist = $numberOfGuest;
        if (isset($author))
            $booking->author = $author;
        if (isset($guests))
            $booking->guests = $guests;
        $booking->apartment = $apartment;
        return $booking;
    }
    public static function createBooking( RentForm $form, $updateTime = null, $apartment_id = null, $author_id = null) :self
    {
            $booking = new static();
            $booking->start_date = $form->from_date;
            $booking->end_date = $form->until_date;
            $booking->external_id = $form->id;
            $booking->number_of_tourist = $form->total_guests;
            $booking->status = ($form->active==="Y")? Booking::STATUS_ACTIVE:Booking::STATUS_NONE;
            $booking->guid= $form->guid;
            $booking->rent_status= $form->rent_status;
            $booking->from_time= $form->from_time;
            $booking->until_time= $form->until_time;
            $booking->price= $form->price;
            $booking->exchange= $form->exchange;
            $booking->label= $form->label;
            $booking->price_local= $form->price_local;
            $booking->paid= $form->paid;
            $booking->created= $form->created;
            $booking->changed= $form->changed;
            $booking->rent_adults   = $form->rent_adults;
            $booking->rent_children = $form->rent_children;
            $booking->note          = $form->note;
            $booking->in_advance    = $form->in_advance;
            $booking->myrent_update = $updateTime;
            $booking->apartment_id  = $apartment_id;
            $booking->guest_id      = $author_id;
        
        return $booking;
    }

    public function edit( RentForm $form, $updateTime = null, $apartment_id = null, $author_id = null)
    {
       
        $this->start_date = $form->from_date;
        $this->end_date = $form->until_date;
        $this->external_id = $form->id;
        $this->number_of_tourist = $form->total_guests;
        $this->status = ($form->active==="Y")? Booking::STATUS_ACTIVE:Booking::STATUS_NONE;
        $this->guid= $form->guid;
        $this->rent_status= $form->rent_status;
        $this->from_time= $form->from_time;
        $this->until_time= $form->until_time;
        $this->price= $form->price;
        $this->exchange= $form->exchange;
        $this->label= $form->label;
        $this->price_local= $form->price_local;
        $this->paid= $form->paid;
        $this->created= $form->created;
        $this->changed= $form->changed;
        $this->rent_adults   = $form->rent_adults;
        $this->rent_children = $form->rent_children;
        $this->note          = $form->note;
        $this->in_advance    = $form->in_advance;
       // $this->local_price   = $form->local_price;
        $this->myrent_update = $updateTime;
       // $this->user_id       = $user_id;
        $this->apartment_id  = $apartment_id;
        $this->guest_id      = $author_id;

        return $this;
    }

    public function deleteBooking(Booking $booking) {
        $booking->status=Booking::STATUS_NONE;
    }

    public function getCurrentStatus(){
        //если сроки уже в прошлом - надо поменять статус на STATUS_PAST

        //если срок идет, но нет ни одного гостя -  STATUS_WARNING


        return $this->status;

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
        return $this->hasMany(Photo::className(), ['booking_id' => 'id']);
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
