<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_prices_notes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $language_id
 * @property string $note
 * @property string $note1
 * @property string $created
 * @property string $changed
 *
 * @property Languages $language
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPricesNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_prices_notes';
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
        * @param int $language_id//
        * @param string $note//
        * @param string $note1//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsPricesNotes    */
    public static function create($id, $user_id, $object_id, $language_id, $note, $note1, $created, $changed): ObjectsPricesNotes
    {
        $objectsPricesNotes = new static();
                $objectsPricesNotes->id = $id;
                $objectsPricesNotes->user_id = $user_id;
                $objectsPricesNotes->object_id = $object_id;
                $objectsPricesNotes->language_id = $language_id;
                $objectsPricesNotes->note = $note;
                $objectsPricesNotes->note1 = $note1;
                $objectsPricesNotes->created = $created;
                $objectsPricesNotes->changed = $changed;
        
        return $objectsPricesNotes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $language_id//
            * @param string $note//
            * @param string $note1//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsPricesNotes    */
    public function edit($id, $user_id, $object_id, $language_id, $note, $note1, $created, $changed): ObjectsPricesNotes
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->language_id = $language_id;
            $this->note = $note;
            $this->note1 = $note1;
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
            'language_id' => Yii::t('app', 'Language ID'),
            'note' => Yii::t('app', 'Note'),
            'note1' => Yii::t('app', 'Note1'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsPricesNotesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsPricesNotesQuery(get_called_class());
    }
}
