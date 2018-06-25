<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "customers_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $note_short
 * @property string $note
 * @property string $note_invoice
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class CustomersTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_types';
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
        * @param string $note_short//
        * @param string $note//
        * @param string $note_invoice//
        * @param string $created//
        * @param string $changed//
        * @return CustomersTypes    */
    public static function create($id, $user_id, $code, $name, $note_short, $note, $note_invoice, $created, $changed): CustomersTypes
    {
        $customersTypes = new static();
                $customersTypes->id = $id;
                $customersTypes->user_id = $user_id;
                $customersTypes->code = $code;
                $customersTypes->name = $name;
                $customersTypes->note_short = $note_short;
                $customersTypes->note = $note;
                $customersTypes->note_invoice = $note_invoice;
                $customersTypes->created = $created;
                $customersTypes->changed = $changed;
        
        return $customersTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $note_short//
            * @param string $note//
            * @param string $note_invoice//
            * @param string $created//
            * @param string $changed//
        * @return CustomersTypes    */
    public function edit($id, $user_id, $code, $name, $note_short, $note, $note_invoice, $created, $changed): CustomersTypes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->name = $name;
            $this->note_short = $note_short;
            $this->note = $note;
            $this->note_invoice = $note_invoice;
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
            'note_short' => Yii::t('app', 'Note Short'),
            'note' => Yii::t('app', 'Note'),
            'note_invoice' => Yii::t('app', 'Note Invoice'),
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
     * @return \reception\entities\MyRent\queries\CustomersTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CustomersTypesQuery(get_called_class());
    }
}
