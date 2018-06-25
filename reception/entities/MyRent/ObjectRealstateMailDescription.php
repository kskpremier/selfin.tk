<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "object_realstate_mail_description".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $unit_id
 * @property int $language_id
 * @property string $email_type
 * @property int $description
 * @property int $file
 * @property string $created
 * @property string $changed
 *
 * @property Locations $language
 * @property Objects $object
 * @property Units $unit
 * @property Users $user
 */
class ObjectRealstateMailDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_realstate_mail_description';
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
        * @param int $object_id//
        * @param int $unit_id//
        * @param int $language_id//
        * @param string $email_type//
        * @param int $description//
        * @param int $file//
        * @param string $created//
        * @param string $changed//
        * @return ObjectRealstateMailDescription    */
    public static function create($id, $user_id, $object_id, $unit_id, $language_id, $email_type, $description, $file, $created, $changed): ObjectRealstateMailDescription
    {
        $objectRealstateMailDescription = new static();
                $objectRealstateMailDescription->id = $id;
                $objectRealstateMailDescription->user_id = $user_id;
                $objectRealstateMailDescription->object_id = $object_id;
                $objectRealstateMailDescription->unit_id = $unit_id;
                $objectRealstateMailDescription->language_id = $language_id;
                $objectRealstateMailDescription->email_type = $email_type;
                $objectRealstateMailDescription->description = $description;
                $objectRealstateMailDescription->file = $file;
                $objectRealstateMailDescription->created = $created;
                $objectRealstateMailDescription->changed = $changed;
        
        return $objectRealstateMailDescription;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $unit_id//
            * @param int $language_id//
            * @param string $email_type//
            * @param int $description//
            * @param int $file//
            * @param string $created//
            * @param string $changed//
        * @return ObjectRealstateMailDescription    */
    public function edit($id, $user_id, $object_id, $unit_id, $language_id, $email_type, $description, $file, $created, $changed): ObjectRealstateMailDescription
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->unit_id = $unit_id;
            $this->language_id = $language_id;
            $this->email_type = $email_type;
            $this->description = $description;
            $this->file = $file;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'email_type' => Yii::t('app', 'Email Type'),
            'description' => Yii::t('app', 'Description'),
            'file' => Yii::t('app', 'File'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Locations::class, ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectRealstateMailDescriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectRealstateMailDescriptionQuery(get_called_class());
    }
}
