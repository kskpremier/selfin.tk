<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;

/**
 * This is the model class for table "objects_facilities_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property string $facility_name
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 */
class ObjectsFacilitiesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_facilities_b2b';
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
        * @param int $b2b_id//
        * @param string $facility_name//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsFacilitiesB2b    */
    public static function create($id, $b2b_id, $facility_name, $value, $created, $changed): ObjectsFacilitiesB2b
    {
        $objectsFacilitiesB2b = new static();
                $objectsFacilitiesB2b->id = $id;
                $objectsFacilitiesB2b->b2b_id = $b2b_id;
                $objectsFacilitiesB2b->facility_name = $facility_name;
                $objectsFacilitiesB2b->value = $value;
                $objectsFacilitiesB2b->created = $created;
                $objectsFacilitiesB2b->changed = $changed;
        
        return $objectsFacilitiesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param string $facility_name//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsFacilitiesB2b    */
    public function edit($id, $b2b_id, $facility_name, $value, $created, $changed): ObjectsFacilitiesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->facility_name = $facility_name;
            $this->value = $value;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'facility_name' => Yii::t('app', 'Facility Name'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsFacilitiesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsFacilitiesB2bQuery(get_called_class());
    }
}
