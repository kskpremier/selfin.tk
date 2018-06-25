<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "invoices_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $number_pos
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader[] $invoicesHeaders
 * @property Users $user
 */
class InvoicesTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_types';
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
        * @param string $type//
        * @param string $code//
        * @param string $name//
        * @param string $number_pos//
        * @param string $created//
        * @param string $changed//
        * @return InvoicesTypes    */
    public static function create($id, $user_id, $type, $code, $name, $number_pos, $created, $changed): InvoicesTypes
    {
        $invoicesTypes = new static();
                $invoicesTypes->id = $id;
                $invoicesTypes->user_id = $user_id;
                $invoicesTypes->type = $type;
                $invoicesTypes->code = $code;
                $invoicesTypes->name = $name;
                $invoicesTypes->number_pos = $number_pos;
                $invoicesTypes->created = $created;
                $invoicesTypes->changed = $changed;
        
        return $invoicesTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $type//
            * @param string $code//
            * @param string $name//
            * @param string $number_pos//
            * @param string $created//
            * @param string $changed//
        * @return InvoicesTypes    */
    public function edit($id, $user_id, $type, $code, $name, $number_pos, $created, $changed): InvoicesTypes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->type = $type;
            $this->code = $code;
            $this->name = $name;
            $this->number_pos = $number_pos;
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
            'type' => Yii::t('app', 'Type'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'number_pos' => Yii::t('app', 'Number Pos'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['invoice_type_id' => 'id']);
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
     * @return \reception\entities\MyRent\queries\InvoicesTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\InvoicesTypesQuery(get_called_class());
    }
}
