<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:18
 */
namespace reception\entities\Booking;

use reception\entities\User\User;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\forms\MyRent\ContactForm;
use Yii;

/**
 * This is the model class for table "guest".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $contact_email
 * @property string $contact_tel
 * @property integer $application_id
 * @property integer $user_id
 * @property integer $document_id
 * @property string $contact_name
 * @property string $contact_country
 * @property string $contact_country_code1
 * @property integer $myrent_update
 * @property string $guid
 *
 *
 * @property Booking[] $bookings
 * @property Dooking $authorBookings
 * @property Application $application
 * @property Document[] $documents
 */
class Guest extends \yii\db\ActiveRecord
{
    public static function create( $first_name, $second_name, $contact_email=null, $user=null, $booking=null,$contact_tel=null, $updatetime=null, $guid=null) :self
    {
        $guest = Guest::find()->where(['first_name'=>$first_name,'second_name'=>$second_name,'contact_email'=>$contact_email])->one();
        if (!isset($guest)) {
            $guest = new static();
            $guest->first_name = $first_name;
            $guest->second_name = $second_name;
            $guest->contact_email = $contact_email;
            $guest->contact_tel = $contact_tel;
            $guest->guid = $guid;
            $guest->myrent_update = ($updatetime) ? $updatetime : time();
            $guest->user = $user;
        }
        else $guest->editGuest($first_name, $second_name, $contact_email, $booking, $contact_tel, $updatetime, $guid);
        $guest->bookings = $booking;
        return $guest;
    }

    public static function createAsTourist( $first_name, $second_name, $contact_country_code1, $booking) :self
    {
            $guest = new static();
            $guest->first_name = $first_name;
            $guest->second_name = $second_name;
            $guest->contact_country_code1 = $contact_country_code1;
            $guest->myrent_update =  time();

        $guest->bookings = $booking;
        return $guest;
    }

    public function editGuest($first_name, $second_name, $contact_email=null, $booking = null, $contact_tel = null, $updatetime = null, $guid = null) :self
    {
        //$names = explode(' ', $second_name);
        $this->first_name = $first_name;//(is_array($names) && array_key_exists(0, $names)) ? $names[0] : '';
        $this->second_name = $second_name;//(is_array($names) && array_key_exists(1, $names)) ? $names[1] : '';
        $this->contact_email = $contact_email;
        $this->contact_tel = $contact_tel;
        $this->contact_name = $first_name." ".$second_name;
        $this->myrent_update = $updatetime;
//        $this->bookings = $booking;
        $this->guid = $guid;
        return $this;
    }

    public static function createContact( ContactForm $form, $updatetime) :self
    {
        $names = explode(' ', $form->contact_name);
        $first_name = (is_array($names) && array_key_exists(0, $names)) ? $names[0] : '';
        $second_name = (is_array($names) && array_key_exists(1, $names)) ? $names[1] : '';
        $guest = Guest::find()->where(['first_name'=>$first_name,'second_name'=>$second_name,'contact_email'=>$form->contact_email])->one();
        if (!isset($guest)) {
            $guest = new static();
            $guest->first_name = $first_name;
            $guest->second_name = $second_name;
            $guest->contact_email = $form->contact_email;
            $guest->contact_tel = $form->contact_tel;
            $guest->contact_name = $form->contact_name;
            $guest->contact_country = $form->contact_country;
            $guest->contact_country_code1 = $form->contact_country_code1;
            $guest->guid = $form->guid;
            $guest->myrent_update = $updatetime;
        }
        else $guest->updateContact( $form, $updatetime);
        return $guest;
    }

    public function updateContact( ContactForm $form, $updatetime) :self
    {
        $names = explode(' ', $form->contact_name);
        $this->first_name = (is_array($names) && array_key_exists(0, $names)) ? $names[0] : '';
        $this->second_name = (is_array($names) && array_key_exists(1, $names)) ? $names[1] : '';
        $this->contact_email = $form->contact_email;
        $this->contact_tel = $form->contact_tel;
        $this->contact_name = $form->contact_name;
        $this->contact_country = $form->contact_country;
        $this->contact_country_code1 = $form->contact_country_code1;
        $this->myrent_update = $updatetime;

        return $this;
    }

    public static function addToBookingGuestList( $first_name, $second_name, $booking ) :self
    {
        $guest = Guest::find()->where(['first_name'=>$first_name,'second_name'=>$second_name])->one();
        if (!isset($guest)) {
            $guest = new static();
            $guest->first_name = $first_name;
            $guest->second_name = $second_name;
        }
        $booking->assignGuest($guest->id);
        return $guest;
    }
//формирует массив гостей в для букинга и возвращает его
    public static function createGuestList($guests) {
        foreach ($guests as $guest){
            $guestList[] = Guest::create(
                $guest->firstName,
                $guest->secondName,
                $guest->contactEmail
                );
        }
        return $guestList;
    }

    public function edit( $first_name,$second_name,$contact_email, $application_id, $user_id, $document_id)
    {
        $this->$first_name = $first_name;
        $this->$second_name = $second_name;
        $this->$contact_email = $contact_email;
        $this->$application_id = $application_id;
        $this->$user_id = $user_id;
        $this->$document_id = $document_id;
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['user', 'bookings'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guest';
    }


    /**
     * Connect guest and booking as group of tourists
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id' => 'booking_id'])->viaTable('{{%booking_guest}}', ['guest_id'=>'id']);
    }

    /**
     * Connect guest and booking as author
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBookings()
    {
        return $this->hasMany(Booking::className(), ['guest_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['guest_id' => 'id']);
    }
}
