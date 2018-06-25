<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "users_invoices".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $adress
 * @property string $city_zip
 * @property string $city_name
 * @property string $oib
 * @property string $tax_id
 * @property string $note
 * @property string $footer
 * @property string $created
 * @property string $changed
 */
class UsersInvoices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_invoices';
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
        * @param string $name//
        * @param string $adress//
        * @param string $city_zip//
        * @param string $city_name//
        * @param string $oib//
        * @param string $tax_id//
        * @param string $note//
        * @param string $footer//
        * @param string $created//
        * @param string $changed//
        * @return UsersInvoices    */
    public static function create($id, $user_id, $name, $adress, $city_zip, $city_name, $oib, $tax_id, $note, $footer, $created, $changed): UsersInvoices
    {
        $usersInvoices = new static();
                $usersInvoices->id = $id;
                $usersInvoices->user_id = $user_id;
                $usersInvoices->name = $name;
                $usersInvoices->adress = $adress;
                $usersInvoices->city_zip = $city_zip;
                $usersInvoices->city_name = $city_name;
                $usersInvoices->oib = $oib;
                $usersInvoices->tax_id = $tax_id;
                $usersInvoices->note = $note;
                $usersInvoices->footer = $footer;
                $usersInvoices->created = $created;
                $usersInvoices->changed = $changed;
        
        return $usersInvoices;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $name//
            * @param string $adress//
            * @param string $city_zip//
            * @param string $city_name//
            * @param string $oib//
            * @param string $tax_id//
            * @param string $note//
            * @param string $footer//
            * @param string $created//
            * @param string $changed//
        * @return UsersInvoices    */
    public function edit($id, $user_id, $name, $adress, $city_zip, $city_name, $oib, $tax_id, $note, $footer, $created, $changed): UsersInvoices
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->name = $name;
            $this->adress = $adress;
            $this->city_zip = $city_zip;
            $this->city_name = $city_name;
            $this->oib = $oib;
            $this->tax_id = $tax_id;
            $this->note = $note;
            $this->footer = $footer;
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
            'name' => Yii::t('app', 'Name'),
            'adress' => Yii::t('app', 'Adress'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'city_name' => Yii::t('app', 'City Name'),
            'oib' => Yii::t('app', 'Oib'),
            'tax_id' => Yii::t('app', 'Tax ID'),
            'note' => Yii::t('app', 'Note'),
            'footer' => Yii::t('app', 'Footer'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersInvoicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersInvoicesQuery(get_called_class());
    }
}
