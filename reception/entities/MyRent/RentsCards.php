<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_cards".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property string $note
 * @property int $open
 * @property string $when
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 */
class RentsCards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_cards';
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
        * @param string $note//
        * @param int $open//
        * @param string $when//
        * @param string $created//
        * @param string $changed//
        * @return RentsCards    */
    public static function create($id, $user_id, $rent_id, $note, $open, $when, $created, $changed): RentsCards
    {
        $rentsCards = new static();
                $rentsCards->id = $id;
                $rentsCards->user_id = $user_id;
                $rentsCards->rent_id = $rent_id;
                $rentsCards->note = $note;
                $rentsCards->open = $open;
                $rentsCards->when = $when;
                $rentsCards->created = $created;
                $rentsCards->changed = $changed;
        
        return $rentsCards;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param string $note//
            * @param int $open//
            * @param string $when//
            * @param string $created//
            * @param string $changed//
        * @return RentsCards    */
    public function edit($id, $user_id, $rent_id, $note, $open, $when, $created, $changed): RentsCards
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->note = $note;
            $this->open = $open;
            $this->when = $when;
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
            'note' => Yii::t('app', 'Note'),
            'open' => Yii::t('app', 'Open'),
            'when' => Yii::t('app', 'When'),
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsCardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsCardsQuery(get_called_class());
    }
}
