<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Amnety;
use reception\entities\MyRent\B2b;

/**
 * This is the model class for table "amenities_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $amnety_id
 * @property int $value
 * @property string $created
 * @property string $changed
 *
 * @property Amenities $amnety
 * @property B2b $b2b
 */
class AmenitiesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amenities_b2b';
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
        * @param int $amnety_id//
        * @param int $value//
        * @param string $created//
        * @param string $changed//
        * @return AmenitiesB2b    */
    public static function create($id, $b2b_id, $amnety_id, $value, $created, $changed): AmenitiesB2b
    {
        $amenitiesB2b = new static();
                $amenitiesB2b->id = $id;
                $amenitiesB2b->b2b_id = $b2b_id;
                $amenitiesB2b->amnety_id = $amnety_id;
                $amenitiesB2b->value = $value;
                $amenitiesB2b->created = $created;
                $amenitiesB2b->changed = $changed;
        
        return $amenitiesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $amnety_id//
            * @param int $value//
            * @param string $created//
            * @param string $changed//
        * @return AmenitiesB2b    */
    public function edit($id, $b2b_id, $amnety_id, $value, $created, $changed): AmenitiesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->amnety_id = $amnety_id;
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
            'amnety_id' => Yii::t('app', 'Amnety ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmnety()
    {
        return $this->hasOne(Amenities::class, ['id' => 'amnety_id']);
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
     * @return \reception\entities\MyRent\queries\AmenitiesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\AmenitiesB2bQuery(get_called_class());
    }
}
