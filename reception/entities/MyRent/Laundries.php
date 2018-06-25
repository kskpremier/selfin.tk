<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsChecksLogs;

/**
 * This is the model class for table "laundries".
 *
 * @property int $id
 * @property int $user_id
 * @property string $guid
 * @property string $color
 * @property string $code
 * @property string $name
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property Objects[] $objects
 * @property ObjectsChecksLogs[] $objectsChecksLogs
 */
class Laundries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laundries';
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
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return Laundries    */
    public static function create($id, $user_id, $guid, $color, $code, $name, $note, $created, $changed): Laundries
    {
        $laundries = new static();
                $laundries->id = $id;
                $laundries->user_id = $user_id;
                $laundries->guid = $guid;
                $laundries->color = $color;
                $laundries->code = $code;
                $laundries->name = $name;
                $laundries->note = $note;
                $laundries->created = $created;
                $laundries->changed = $changed;
        
        return $laundries;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $guid//
            * @param string $color//
            * @param string $code//
            * @param string $name//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return Laundries    */
    public function edit($id, $user_id, $guid, $color, $code, $name, $note, $created, $changed): Laundries
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->guid = $guid;
            $this->color = $color;
            $this->code = $code;
            $this->name = $name;
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
            'guid' => Yii::t('app', 'Guid'),
            'color' => Yii::t('app', 'Color'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
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
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['laundry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['laundry_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LaundriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LaundriesQuery(get_called_class());
    }
}
