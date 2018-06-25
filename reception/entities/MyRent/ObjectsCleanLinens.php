<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsChecksLogs;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsMaintenances;

/**
 * This is the model class for table "objects_clean_linens".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $color
 * @property string $name
 * @property string $note
 * @property string $on_arival
 * @property string $on_departure
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsChecksLogs[] $objectsChecksLogs
 * @property Users $user
 * @property ObjectsMaintenance[] $objectsMaintenances
 */
class ObjectsCleanLinens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_clean_linens';
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
        * @param string $color//
        * @param string $name//
        * @param string $note//
        * @param string $on_arival//
        * @param string $on_departure//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsCleanLinens    */
    public static function create($id, $user_id, $code, $color, $name, $note, $on_arival, $on_departure, $created, $changed): ObjectsCleanLinens
    {
        $objectsCleanLinens = new static();
                $objectsCleanLinens->id = $id;
                $objectsCleanLinens->user_id = $user_id;
                $objectsCleanLinens->code = $code;
                $objectsCleanLinens->color = $color;
                $objectsCleanLinens->name = $name;
                $objectsCleanLinens->note = $note;
                $objectsCleanLinens->on_arival = $on_arival;
                $objectsCleanLinens->on_departure = $on_departure;
                $objectsCleanLinens->created = $created;
                $objectsCleanLinens->changed = $changed;
        
        return $objectsCleanLinens;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $color//
            * @param string $name//
            * @param string $note//
            * @param string $on_arival//
            * @param string $on_departure//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsCleanLinens    */
    public function edit($id, $user_id, $code, $color, $name, $note, $on_arival, $on_departure, $created, $changed): ObjectsCleanLinens
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->code = $code;
            $this->color = $color;
            $this->name = $name;
            $this->note = $note;
            $this->on_arival = $on_arival;
            $this->on_departure = $on_departure;
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
            'color' => Yii::t('app', 'Color'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'on_arival' => Yii::t('app', 'On Arival'),
            'on_departure' => Yii::t('app', 'On Departure'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['clean_linen_id' => 'id']);
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
    public function getObjectsMaintenances()
    {
        return $this->hasMany(ObjectsMaintenance::class, ['clean_linen_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsCleanLinensQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsCleanLinensQuery(get_called_class());
    }
}
