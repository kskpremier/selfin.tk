<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\RentGroup;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_groups_rents".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_group_id
 * @property int $rent_id
 * @property string $paid
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property RentsGroups $rentGroup
 * @property Users $user
 */
class RentsGroupsRents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_groups_rents';
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
        * @param int $rent_group_id//
        * @param int $rent_id//
        * @param string $paid//
        * @param string $created//
        * @param string $changed//
        * @return RentsGroupsRents    */
    public static function create($id, $user_id, $rent_group_id, $rent_id, $paid, $created, $changed): RentsGroupsRents
    {
        $rentsGroupsRents = new static();
                $rentsGroupsRents->id = $id;
                $rentsGroupsRents->user_id = $user_id;
                $rentsGroupsRents->rent_group_id = $rent_group_id;
                $rentsGroupsRents->rent_id = $rent_id;
                $rentsGroupsRents->paid = $paid;
                $rentsGroupsRents->created = $created;
                $rentsGroupsRents->changed = $changed;
        
        return $rentsGroupsRents;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_group_id//
            * @param int $rent_id//
            * @param string $paid//
            * @param string $created//
            * @param string $changed//
        * @return RentsGroupsRents    */
    public function edit($id, $user_id, $rent_group_id, $rent_id, $paid, $created, $changed): RentsGroupsRents
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_group_id = $rent_group_id;
            $this->rent_id = $rent_id;
            $this->paid = $paid;
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
            'rent_group_id' => Yii::t('app', 'Rent Group ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'paid' => Yii::t('app', 'Paid'),
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
    public function getRentGroup()
    {
        return $this->hasOne(RentsGroups::class, ['id' => 'rent_group_id']);
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
     * @return \reception\entities\MyRent\queries\RentsGroupsRentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsGroupsRentsQuery(get_called_class());
    }
}
