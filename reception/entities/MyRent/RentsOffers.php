<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_offers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property string $valid_until
 * @property string $pay_link_advance
 * @property string $pay_link_full
 * @property string $pay_link_difference
 * @property string $show_object_detail show detail of object in guest portal
 * @property string $valid_time
 * @property string $text_general
 * @property string $text_conditions
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 */
class RentsOffers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_offers';
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
        * @param string $valid_until//
        * @param string $pay_link_advance//
        * @param string $pay_link_full//
        * @param string $pay_link_difference//
        * @param string $show_object_detail// show detail of object in guest portal
        * @param string $valid_time//
        * @param string $text_general//
        * @param string $text_conditions//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return RentsOffers    */
    public static function create($id, $user_id, $rent_id, $valid_until, $pay_link_advance, $pay_link_full, $pay_link_difference, $show_object_detail, $valid_time, $text_general, $text_conditions, $active, $created, $changed): RentsOffers
    {
        $rentsOffers = new static();
                $rentsOffers->id = $id;
                $rentsOffers->user_id = $user_id;
                $rentsOffers->rent_id = $rent_id;
                $rentsOffers->valid_until = $valid_until;
                $rentsOffers->pay_link_advance = $pay_link_advance;
                $rentsOffers->pay_link_full = $pay_link_full;
                $rentsOffers->pay_link_difference = $pay_link_difference;
                $rentsOffers->show_object_detail = $show_object_detail;
                $rentsOffers->valid_time = $valid_time;
                $rentsOffers->text_general = $text_general;
                $rentsOffers->text_conditions = $text_conditions;
                $rentsOffers->active = $active;
                $rentsOffers->created = $created;
                $rentsOffers->changed = $changed;
        
        return $rentsOffers;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param string $valid_until//
            * @param string $pay_link_advance//
            * @param string $pay_link_full//
            * @param string $pay_link_difference//
            * @param string $show_object_detail// show detail of object in guest portal
            * @param string $valid_time//
            * @param string $text_general//
            * @param string $text_conditions//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return RentsOffers    */
    public function edit($id, $user_id, $rent_id, $valid_until, $pay_link_advance, $pay_link_full, $pay_link_difference, $show_object_detail, $valid_time, $text_general, $text_conditions, $active, $created, $changed): RentsOffers
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->valid_until = $valid_until;
            $this->pay_link_advance = $pay_link_advance;
            $this->pay_link_full = $pay_link_full;
            $this->pay_link_difference = $pay_link_difference;
            $this->show_object_detail = $show_object_detail;
            $this->valid_time = $valid_time;
            $this->text_general = $text_general;
            $this->text_conditions = $text_conditions;
            $this->active = $active;
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
            'valid_until' => Yii::t('app', 'Valid Until'),
            'pay_link_advance' => Yii::t('app', 'Pay Link Advance'),
            'pay_link_full' => Yii::t('app', 'Pay Link Full'),
            'pay_link_difference' => Yii::t('app', 'Pay Link Difference'),
            'show_object_detail' => Yii::t('app', 'Show Object Detail'),
            'valid_time' => Yii::t('app', 'Valid Time'),
            'text_general' => Yii::t('app', 'Text General'),
            'text_conditions' => Yii::t('app', 'Text Conditions'),
            'active' => Yii::t('app', 'Active'),
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
     * @return \reception\entities\MyRent\queries\RentsOffersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsOffersQuery(get_called_class());
    }
}
