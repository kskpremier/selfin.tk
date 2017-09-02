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
use Yii;

/**
 * This is the model class for table "guest".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $contact_email
 * @property integer $application_id
 * @property integer $user_id
 * @property integer $document_id
 *
 * @property Booking[] $bookings
 * @property Application $application
 * @property Document[] $documents
 */
class Guest extends \yii\db\ActiveRecord
{
    public static function create( $first_name, $second_name, $contact_email, $user, $booking=null) :self
    {
        $guest = Guest::find()->where(['first_name'=>$first_name,'second_name'=>$second_name,'contact_email'=>$contact_email])->one();
        if (!isset($guest)) {
            $guest = new static();
            $guest->first_name = $first_name;
            $guest->second_name = $second_name;
            $guest->contact_email = $contact_email;
            $guest->user = $user;
        }
        $guest->bookings = $booking;
        return $guest;
    }

    public static function addToBookingGuestList( $first_name, $second_name, $booking ) :self
    {
        $guest = Guest::find()->where(['first_name'=>$first_name,'second_name'=>$second_name])->one();
        if (!isset($guest)) {
            $guest = new static();
            $guest->first_name = $first_name;
            $guest->second_name = $second_name;
        }
        $guest->bookings = $booking;
        return $guest;
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
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id' => 'booking_id'])->viaTable('{{%booking_guest}}', ['guest_id'=>'id']);
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
        return $this->hasMany(Document::className(), ['document_id' => 'id']);
    }
}
