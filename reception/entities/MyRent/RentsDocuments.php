<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_documents".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property string $code
 * @property string $name
 * @property string $note
 * @property string $file_name
 * @property double $file_size
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 */
class RentsDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_documents';
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
        * @param string $code//
        * @param string $name//
        * @param string $note//
        * @param string $file_name//
        * @param double $file_size//
        * @param string $created//
        * @param string $changed//
        * @return RentsDocuments    */
    public static function create($id, $user_id, $rent_id, $code, $name, $note, $file_name, $file_size, $created, $changed): RentsDocuments
    {
        $rentsDocuments = new static();
                $rentsDocuments->id = $id;
                $rentsDocuments->user_id = $user_id;
                $rentsDocuments->rent_id = $rent_id;
                $rentsDocuments->code = $code;
                $rentsDocuments->name = $name;
                $rentsDocuments->note = $note;
                $rentsDocuments->file_name = $file_name;
                $rentsDocuments->file_size = $file_size;
                $rentsDocuments->created = $created;
                $rentsDocuments->changed = $changed;
        
        return $rentsDocuments;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param string $code//
            * @param string $name//
            * @param string $note//
            * @param string $file_name//
            * @param double $file_size//
            * @param string $created//
            * @param string $changed//
        * @return RentsDocuments    */
    public function edit($id, $user_id, $rent_id, $code, $name, $note, $file_name, $file_size, $created, $changed): RentsDocuments
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->code = $code;
            $this->name = $name;
            $this->note = $note;
            $this->file_name = $file_name;
            $this->file_size = $file_size;
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_size' => Yii::t('app', 'File Size'),
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
     * @return \reception\entities\MyRent\queries\RentsDocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsDocumentsQuery(get_called_class());
    }
}
