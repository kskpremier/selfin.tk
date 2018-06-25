<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Customers;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Reports;

/**
 * This is the model class for table "customers_groups".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $color
 * @property string $note_short
 * @property string $note
 * @property string $note_invoice
 * @property double $discount
 * @property string $created
 * @property string $changed
 *
 * @property Customers[] $customers
 * @property Users $user
 * @property Reports[] $reports
 */
class CustomersGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_groups';
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
        * @param string $color//
        * @param string $note_short//
        * @param string $note//
        * @param string $note_invoice//
        * @param double $discount//
        * @param string $created//
        * @param string $changed//
        * @return CustomersGroups    */
    public static function create($id, $user_id, $code, $name, $color, $note_short, $note, $note_invoice, $discount, $created, $changed): CustomersGroups
    {
        $customersGroups = new static();
                $customersGroups->id = $id;
                $customersGroups->user_id = $user_id;
                $customersGroups->code = $code;
                $customersGroups->name = $name;
                $customersGroups->color = $color;
                $customersGroups->note_short = $note_short;
                $customersGroups->note = $note;
                $customersGroups->note_invoice = $note_invoice;
                $customersGroups->discount = $discount;
                $customersGroups->created = $created;
                $customersGroups->changed = $changed;
        
        return $customersGroups;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $color//
            * @param string $note_short//
            * @param string $note//
            * @param string $note_invoice//
            * @param double $discount//
            * @param string $created//
            * @param string $changed//
        * @return CustomersGroups    */
    public function edit($id, $user_id, $code, $name, $color, $note_short, $note, $note_invoice, $discount, $created, $changed): CustomersGroups
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
            $this->color = $color;
            $this->note_short = $note_short;
            $this->note = $note;
            $this->note_invoice = $note_invoice;
            $this->discount = $discount;
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
            'color' => Yii::t('app', 'Color'),
            'note_short' => Yii::t('app', 'Note Short'),
            'note' => Yii::t('app', 'Note'),
            'note_invoice' => Yii::t('app', 'Note Invoice'),
            'discount' => Yii::t('app', 'Discount'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::class, ['customer_group_id' => 'id']);
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
    public function getReports()
    {
        return $this->hasMany(Reports::class, ['customer_group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CustomersGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CustomersGroupsQuery(get_called_class());
    }
}
