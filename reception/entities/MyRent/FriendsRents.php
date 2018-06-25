<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\Friend;

/**
 * This is the model class for table "friends_rents".
 *
 * @property int $id
 * @property int $rent_id
 * @property int $friend_id
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Friends $friend
 */
class FriendsRents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends_rents';
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
        * @param int $rent_id//
        * @param int $friend_id//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return FriendsRents    */
    public static function create($id, $rent_id, $friend_id, $note, $created, $changed): FriendsRents
    {
        $friendsRents = new static();
                $friendsRents->id = $id;
                $friendsRents->rent_id = $rent_id;
                $friendsRents->friend_id = $friend_id;
                $friendsRents->note = $note;
                $friendsRents->created = $created;
                $friendsRents->changed = $changed;
        
        return $friendsRents;
    }

    /**
            * @param int $id//
            * @param int $rent_id//
            * @param int $friend_id//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return FriendsRents    */
    public function edit($id, $rent_id, $friend_id, $note, $created, $changed): FriendsRents
    {

            $this->id = $id;
            $this->rent_id = $rent_id;
            $this->friend_id = $friend_id;
            $this->note = $note;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'friend_id' => Yii::t('app', 'Friend ID'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
    public function getFriend()
    {
        return $this->hasOne(Friends::class, ['id' => 'friend_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\FriendsRentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\FriendsRentsQuery(get_called_class());
    }
}
