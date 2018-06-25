<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property int $object_id
 * @property string $date date and time of creating review
 * @property int $rating
 * @property int $rating_accuracy
 * @property int $rating_check_in
 * @property int $rating_cleanliness
 * @property int $rating_communication
 * @property int $rating_location
 * @property int $rating_value_for_money
 * @property string $note_internal
 * @property string $contact_name
 * @property int $contact_country_id
 * @property string $note_public
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Rents $rent
 * @property Users $user
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
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
        * @param int $object_id//
        * @param string $date// date and time of creating review
        * @param int $rating//
        * @param int $rating_accuracy//
        * @param int $rating_check_in//
        * @param int $rating_cleanliness//
        * @param int $rating_communication//
        * @param int $rating_location//
        * @param int $rating_value_for_money//
        * @param string $note_internal//
        * @param string $contact_name//
        * @param int $contact_country_id//
        * @param string $note_public//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return Reviews    */
    public static function create($id, $user_id, $rent_id, $object_id, $date, $rating, $rating_accuracy, $rating_check_in, $rating_cleanliness, $rating_communication, $rating_location, $rating_value_for_money, $note_internal, $contact_name, $contact_country_id, $note_public, $active, $created, $changed): Reviews
    {
        $reviews = new static();
                $reviews->id = $id;
                $reviews->user_id = $user_id;
                $reviews->rent_id = $rent_id;
                $reviews->object_id = $object_id;
                $reviews->date = $date;
                $reviews->rating = $rating;
                $reviews->rating_accuracy = $rating_accuracy;
                $reviews->rating_check_in = $rating_check_in;
                $reviews->rating_cleanliness = $rating_cleanliness;
                $reviews->rating_communication = $rating_communication;
                $reviews->rating_location = $rating_location;
                $reviews->rating_value_for_money = $rating_value_for_money;
                $reviews->note_internal = $note_internal;
                $reviews->contact_name = $contact_name;
                $reviews->contact_country_id = $contact_country_id;
                $reviews->note_public = $note_public;
                $reviews->active = $active;
                $reviews->created = $created;
                $reviews->changed = $changed;
        
        return $reviews;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param int $object_id//
            * @param string $date// date and time of creating review
            * @param int $rating//
            * @param int $rating_accuracy//
            * @param int $rating_check_in//
            * @param int $rating_cleanliness//
            * @param int $rating_communication//
            * @param int $rating_location//
            * @param int $rating_value_for_money//
            * @param string $note_internal//
            * @param string $contact_name//
            * @param int $contact_country_id//
            * @param string $note_public//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return Reviews    */
    public function edit($id, $user_id, $rent_id, $object_id, $date, $rating, $rating_accuracy, $rating_check_in, $rating_cleanliness, $rating_communication, $rating_location, $rating_value_for_money, $note_internal, $contact_name, $contact_country_id, $note_public, $active, $created, $changed): Reviews
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->object_id = $object_id;
            $this->date = $date;
            $this->rating = $rating;
            $this->rating_accuracy = $rating_accuracy;
            $this->rating_check_in = $rating_check_in;
            $this->rating_cleanliness = $rating_cleanliness;
            $this->rating_communication = $rating_communication;
            $this->rating_location = $rating_location;
            $this->rating_value_for_money = $rating_value_for_money;
            $this->note_internal = $note_internal;
            $this->contact_name = $contact_name;
            $this->contact_country_id = $contact_country_id;
            $this->note_public = $note_public;
            $this->active = $active;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'date' => Yii::t('app', 'Date'),
            'rating' => Yii::t('app', 'Rating'),
            'rating_accuracy' => Yii::t('app', 'Rating Accuracy'),
            'rating_check_in' => Yii::t('app', 'Rating Check In'),
            'rating_cleanliness' => Yii::t('app', 'Rating Cleanliness'),
            'rating_communication' => Yii::t('app', 'Rating Communication'),
            'rating_location' => Yii::t('app', 'Rating Location'),
            'rating_value_for_money' => Yii::t('app', 'Rating Value For Money'),
            'note_internal' => Yii::t('app', 'Note Internal'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'contact_country_id' => Yii::t('app', 'Contact Country ID'),
            'note_public' => Yii::t('app', 'Note Public'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
     * @return \reception\entities\MyRent\queries\ReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ReviewsQuery(get_called_class());
    }
}
