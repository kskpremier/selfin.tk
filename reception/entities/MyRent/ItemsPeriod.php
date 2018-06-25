<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ItemsPrices;

/**
 * This is the model class for table "items_period".
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property int $object_id
 * @property string $date_from
 * @property string $date_until
 * @property string $code
 * @property string $name
 * @property string $note
 * @property string $color
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Units $unit
 * @property Users $user
 * @property ItemsPrices[] $itemsPrices
 */
class ItemsPeriod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_period';
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
        * @param int $unit_id//
        * @param int $object_id//
        * @param string $date_from//
        * @param string $date_until//
        * @param string $code//
        * @param string $name//
        * @param string $note//
        * @param string $color//
        * @param string $created//
        * @param string $changed//
        * @return ItemsPeriod    */
    public static function create($id, $user_id, $unit_id, $object_id, $date_from, $date_until, $code, $name, $note, $color, $created, $changed): ItemsPeriod
    {
        $itemsPeriod = new static();
                $itemsPeriod->id = $id;
                $itemsPeriod->user_id = $user_id;
                $itemsPeriod->unit_id = $unit_id;
                $itemsPeriod->object_id = $object_id;
                $itemsPeriod->date_from = $date_from;
                $itemsPeriod->date_until = $date_until;
                $itemsPeriod->code = $code;
                $itemsPeriod->name = $name;
                $itemsPeriod->note = $note;
                $itemsPeriod->color = $color;
                $itemsPeriod->created = $created;
                $itemsPeriod->changed = $changed;
        
        return $itemsPeriod;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $unit_id//
            * @param int $object_id//
            * @param string $date_from//
            * @param string $date_until//
            * @param string $code//
            * @param string $name//
            * @param string $note//
            * @param string $color//
            * @param string $created//
            * @param string $changed//
        * @return ItemsPeriod    */
    public function edit($id, $user_id, $unit_id, $object_id, $date_from, $date_until, $code, $name, $note, $color, $created, $changed): ItemsPeriod
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->unit_id = $unit_id;
            $this->object_id = $object_id;
            $this->date_from = $date_from;
            $this->date_until = $date_until;
            $this->code = $code;
            $this->name = $name;
            $this->note = $note;
            $this->color = $color;
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_until' => Yii::t('app', 'Date Until'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'color' => Yii::t('app', 'Color'),
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
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPrices()
    {
        return $this->hasMany(ItemsPrices::class, ['period_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ItemsPeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ItemsPeriodQuery(get_called_class());
    }
}
