<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "units_paypal".
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property string $email
 * @property string $item_code
 * @property string $item_name
 * @property string $currency_code
 * @property string $tax_rate
 * @property string $shipping
 * @property string $enable
 * @property string $created
 * @property string $changed
 */
class UnitsPaypal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_paypal';
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
        * @param string $email//
        * @param string $item_code//
        * @param string $item_name//
        * @param string $currency_code//
        * @param string $tax_rate//
        * @param string $shipping//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return UnitsPaypal    */
    public static function create($id, $user_id, $unit_id, $email, $item_code, $item_name, $currency_code, $tax_rate, $shipping, $enable, $created, $changed): UnitsPaypal
    {
        $unitsPaypal = new static();
                $unitsPaypal->id = $id;
                $unitsPaypal->user_id = $user_id;
                $unitsPaypal->unit_id = $unit_id;
                $unitsPaypal->email = $email;
                $unitsPaypal->item_code = $item_code;
                $unitsPaypal->item_name = $item_name;
                $unitsPaypal->currency_code = $currency_code;
                $unitsPaypal->tax_rate = $tax_rate;
                $unitsPaypal->shipping = $shipping;
                $unitsPaypal->enable = $enable;
                $unitsPaypal->created = $created;
                $unitsPaypal->changed = $changed;
        
        return $unitsPaypal;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $unit_id//
            * @param string $email//
            * @param string $item_code//
            * @param string $item_name//
            * @param string $currency_code//
            * @param string $tax_rate//
            * @param string $shipping//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return UnitsPaypal    */
    public function edit($id, $user_id, $unit_id, $email, $item_code, $item_name, $currency_code, $tax_rate, $shipping, $enable, $created, $changed): UnitsPaypal
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->unit_id = $unit_id;
            $this->email = $email;
            $this->item_code = $item_code;
            $this->item_name = $item_name;
            $this->currency_code = $currency_code;
            $this->tax_rate = $tax_rate;
            $this->shipping = $shipping;
            $this->enable = $enable;
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
            'email' => Yii::t('app', 'Email'),
            'item_code' => Yii::t('app', 'Item Code'),
            'item_name' => Yii::t('app', 'Item Name'),
            'currency_code' => Yii::t('app', 'Currency Code'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'shipping' => Yii::t('app', 'Shipping'),
            'enable' => Yii::t('app', 'Enable'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitsPaypalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsPaypalQuery(get_called_class());
    }
}
