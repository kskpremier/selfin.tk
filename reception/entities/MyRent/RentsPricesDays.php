<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_prices_days".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property string $day
 * @property double $price
 * @property string $item
 * @property string $note
 * @property string $genius
 * @property string $import
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 */
class RentsPricesDays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_prices_days';
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
        * @param string $day//
        * @param double $price//
        * @param string $item//
        * @param string $note//
        * @param string $genius//
        * @param string $import//
        * @param string $created//
        * @param string $changed//
        * @return RentsPricesDays    */
    public static function create($id, $user_id, $rent_id, $day, $price, $item, $note, $genius, $import, $created, $changed): RentsPricesDays
    {
        $rentsPricesDays = new static();
                $rentsPricesDays->id = $id;
                $rentsPricesDays->user_id = $user_id;
                $rentsPricesDays->rent_id = $rent_id;
                $rentsPricesDays->day = $day;
                $rentsPricesDays->price = $price;
                $rentsPricesDays->item = $item;
                $rentsPricesDays->note = $note;
                $rentsPricesDays->genius = $genius;
                $rentsPricesDays->import = $import;
                $rentsPricesDays->created = $created;
                $rentsPricesDays->changed = $changed;
        
        return $rentsPricesDays;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param string $day//
            * @param double $price//
            * @param string $item//
            * @param string $note//
            * @param string $genius//
            * @param string $import//
            * @param string $created//
            * @param string $changed//
        * @return RentsPricesDays    */
    public function edit($id, $user_id, $rent_id, $day, $price, $item, $note, $genius, $import, $created, $changed): RentsPricesDays
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->day = $day;
            $this->price = $price;
            $this->item = $item;
            $this->note = $note;
            $this->genius = $genius;
            $this->import = $import;
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
            'day' => Yii::t('app', 'Day'),
            'price' => Yii::t('app', 'Price'),
            'item' => Yii::t('app', 'Item'),
            'note' => Yii::t('app', 'Note'),
            'genius' => Yii::t('app', 'Genius'),
            'import' => Yii::t('app', 'Import'),
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
     * @return \reception\entities\MyRent\queries\RentsPricesDaysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsPricesDaysQuery(get_called_class());
    }
}
