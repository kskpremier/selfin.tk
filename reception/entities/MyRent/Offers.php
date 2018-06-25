<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\OffersObjects;

/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property int $user_id
 * @property string $contact_name
 * @property string $contact_email
 * @property string $contact_tel
 * @property string $contact_country_id
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property OffersObjects[] $offersObjects
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers';
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
        * @param string $contact_name//
        * @param string $contact_email//
        * @param string $contact_tel//
        * @param string $contact_country_id//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return Offers    */
    public static function create($id, $user_id, $contact_name, $contact_email, $contact_tel, $contact_country_id, $note, $created, $changed): Offers
    {
        $offers = new static();
                $offers->id = $id;
                $offers->user_id = $user_id;
                $offers->contact_name = $contact_name;
                $offers->contact_email = $contact_email;
                $offers->contact_tel = $contact_tel;
                $offers->contact_country_id = $contact_country_id;
                $offers->note = $note;
                $offers->created = $created;
                $offers->changed = $changed;
        
        return $offers;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $contact_name//
            * @param string $contact_email//
            * @param string $contact_tel//
            * @param string $contact_country_id//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return Offers    */
    public function edit($id, $user_id, $contact_name, $contact_email, $contact_tel, $contact_country_id, $note, $created, $changed): Offers
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->contact_name = $contact_name;
            $this->contact_email = $contact_email;
            $this->contact_tel = $contact_tel;
            $this->contact_country_id = $contact_country_id;
            $this->note = $note;
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
            'contact_name' => Yii::t('app', 'Contact Name'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_tel' => Yii::t('app', 'Contact Tel'),
            'contact_country_id' => Yii::t('app', 'Contact Country ID'),
            'note' => Yii::t('app', 'Note'),
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
    public function getOffersObjects()
    {
        return $this->hasMany(OffersObjects::class, ['offer_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\OffersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\OffersQuery(get_called_class());
    }
}
