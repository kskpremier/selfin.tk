<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "unit_welcome_description".
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property int $country_id
 * @property string $description
 * @property string $created
 * @property string $changed
 *
 * @property Countries $country
 * @property Units $unit
 * @property Users $user
 */
class UnitWelcomeDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_welcome_description';
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
        * @param int $country_id//
        * @param string $description//
        * @param string $created//
        * @param string $changed//
        * @return UnitWelcomeDescription    */
    public static function create($id, $user_id, $unit_id, $country_id, $description, $created, $changed): UnitWelcomeDescription
    {
        $unitWelcomeDescription = new static();
                $unitWelcomeDescription->id = $id;
                $unitWelcomeDescription->user_id = $user_id;
                $unitWelcomeDescription->unit_id = $unit_id;
                $unitWelcomeDescription->country_id = $country_id;
                $unitWelcomeDescription->description = $description;
                $unitWelcomeDescription->created = $created;
                $unitWelcomeDescription->changed = $changed;
        
        return $unitWelcomeDescription;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $unit_id//
            * @param int $country_id//
            * @param string $description//
            * @param string $created//
            * @param string $changed//
        * @return UnitWelcomeDescription    */
    public function edit($id, $user_id, $unit_id, $country_id, $description, $created, $changed): UnitWelcomeDescription
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->unit_id = $unit_id;
            $this->country_id = $country_id;
            $this->description = $description;
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
            'country_id' => Yii::t('app', 'Country ID'),
            'description' => Yii::t('app', 'Description'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'country_id']);
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitWelcomeDescriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitWelcomeDescriptionQuery(get_called_class());
    }
}
