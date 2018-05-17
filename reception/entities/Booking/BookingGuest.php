<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 4/30/18
 * Time: 8:57 AM
 */


namespace reception\entities\Booking;

use yii\db\ActiveRecord;

/**
 * @property integer $booking_id;
 * @property integer $guest_id;
 */
class BookingGuest extends ActiveRecord
{
    public static function create($guestId): self
    {
        $bookingGuest = new static();
        $bookingGuest->guest_id = $guestId;
//        $bookingGuest->booking_id = $bookingId;
        return $bookingGuest;
    }

    public function isForGuest($id): bool
    {
        return $this->guest_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%booking_guest}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }
}