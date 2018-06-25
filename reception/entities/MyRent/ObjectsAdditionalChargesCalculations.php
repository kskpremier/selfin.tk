<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_additional_charges_calculations".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class ObjectsAdditionalChargesCalculations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_additional_charges_calculations';
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
        * @param string $created//
        * @param string $changed//
        * @return ObjectsAdditionalChargesCalculations    */
    public static function create($id, $user_id, $code, $name, $created, $changed): ObjectsAdditionalChargesCalculations
    {
        $objectsAdditionalChargesCalculations = new static();
                $objectsAdditionalChargesCalculations->id = $id;
                $objectsAdditionalChargesCalculations->user_id = $user_id;
                $objectsAdditionalChargesCalculations->code = $code;
                $objectsAdditionalChargesCalculations->name = $name;
                $objectsAdditionalChargesCalculations->created = $created;
                $objectsAdditionalChargesCalculations->changed = $changed;
        
        return $objectsAdditionalChargesCalculations;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsAdditionalChargesCalculations    */
    public function edit($id, $user_id, $code, $name, $created, $changed): ObjectsAdditionalChargesCalculations
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsAdditionalChargesCalculationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsAdditionalChargesCalculationsQuery(get_called_class());
    }
}
