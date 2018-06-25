<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsDistancesUnitsB2bs;

/**
 * This is the model class for table "objects_distances_units".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $name_short
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property ObjectsDistancesUnitsB2b[] $objectsDistancesUnitsB2bs
 */
class ObjectsDistancesUnits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_distances_units';
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
        * @param string $code//
        * @param string $name//
        * @param string $name_short//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsDistancesUnits    */
    public static function create($id, $user_id, $code, $name, $name_short, $created, $changed): ObjectsDistancesUnits
    {
        $objectsDistancesUnits = new static();
                $objectsDistancesUnits->id = $id;
                $objectsDistancesUnits->user_id = $user_id;
                $objectsDistancesUnits->code = $code;
                $objectsDistancesUnits->name = $name;
                $objectsDistancesUnits->name_short = $name_short;
                $objectsDistancesUnits->created = $created;
                $objectsDistancesUnits->changed = $changed;
        
        return $objectsDistancesUnits;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $name_short//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsDistancesUnits    */
    public function edit($id, $user_id, $code, $name, $name_short, $created, $changed): ObjectsDistancesUnits
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
            $this->name_short = $name_short;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'name_short' => Yii::t('app', 'Name Short'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
    public function getObjectsDistancesUnitsB2bs()
    {
        return $this->hasMany(ObjectsDistancesUnitsB2b::class, ['objects_distances_units_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsDistancesUnitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsDistancesUnitsQuery(get_called_class());
    }
}
