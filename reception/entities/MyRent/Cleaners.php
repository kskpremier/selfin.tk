<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsChecksLogs;
use reception\entities\MyRent\ObjectsChecksLogs0;
use reception\entities\MyRent\Rents;

/**
 * This is the model class for table "cleaners".
 *
 * @property int $id
 * @property int $user_id
 * @property string $guid
 * @property string $color
 * @property string $code
 * @property string $name
 * @property string $tel
 * @property string $email
 * @property string $note
 * @property string $details_extra show extra details of reservation
 * @property string $list_details_closed show list closed
 * @property string $extra_notes show extra notes in mobile applciation
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property Objects[] $objects
 * @property ObjectsChecksLogs[] $objectsChecksLogs
 * @property ObjectsChecksLogs[] $objectsChecksLogs0
 * @property Rents[] $rents
 */
class Cleaners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cleaners';
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
        * @param string $guid//
        * @param string $color//
        * @param string $code//
        * @param string $name//
        * @param string $tel//
        * @param string $email//
        * @param string $note//
        * @param string $details_extra// show extra details of reservation
        * @param string $list_details_closed// show list closed
        * @param string $extra_notes// show extra notes in mobile applciation
        * @param string $created//
        * @param string $changed//
        * @return Cleaners    */
    public static function create($id, $user_id, $guid, $color, $code, $name, $tel, $email, $note, $details_extra, $list_details_closed, $extra_notes, $created, $changed): Cleaners
    {
        $cleaners = new static();
                $cleaners->id = $id;
                $cleaners->user_id = $user_id;
                $cleaners->guid = $guid;
                $cleaners->color = $color;
                $cleaners->code = $code;
                $cleaners->name = $name;
                $cleaners->tel = $tel;
                $cleaners->email = $email;
                $cleaners->note = $note;
                $cleaners->details_extra = $details_extra;
                $cleaners->list_details_closed = $list_details_closed;
                $cleaners->extra_notes = $extra_notes;
                $cleaners->created = $created;
                $cleaners->changed = $changed;
        
        return $cleaners;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $guid//
            * @param string $color//
            * @param string $code//
            * @param string $name//
            * @param string $tel//
            * @param string $email//
            * @param string $note//
            * @param string $details_extra// show extra details of reservation
            * @param string $list_details_closed// show list closed
            * @param string $extra_notes// show extra notes in mobile applciation
            * @param string $created//
            * @param string $changed//
        * @return Cleaners    */
    public function edit($id, $user_id, $guid, $color, $code, $name, $tel, $email, $note, $details_extra, $list_details_closed, $extra_notes, $created, $changed): Cleaners
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guid = $guid;
            $this->color = $color;
            $this->code = $code;
            $this->name = $name;
            $this->tel = $tel;
            $this->email = $email;
            $this->note = $note;
            $this->details_extra = $details_extra;
            $this->list_details_closed = $list_details_closed;
            $this->extra_notes = $extra_notes;
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
            'guid' => Yii::t('app', 'Guid'),
            'color' => Yii::t('app', 'Color'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'tel' => Yii::t('app', 'Tel'),
            'email' => Yii::t('app', 'Email'),
            'note' => Yii::t('app', 'Note'),
            'details_extra' => Yii::t('app', 'Details Extra'),
            'list_details_closed' => Yii::t('app', 'List Details Closed'),
            'extra_notes' => Yii::t('app', 'Extra Notes'),
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
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['cleaner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['clean_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs0()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['cleaner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['cleaner_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CleanersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CleanersQuery(get_called_class());
    }
}
