<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsMaintenances;

/**
 * This is the model class for table "objects_cleans".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $color
 * @property string $name
 * @property string $note
 * @property string $on_arival put this status on arival (auto job)
 * @property string $on_departure put this status on departure (auto job)
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property ObjectsMaintenance[] $objectsMaintenances
 */
class ObjectsCleans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_cleans';
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
        * @param string $on_arival// put this status on arival (auto job)
        * @param string $on_departure// put this status on departure (auto job)
        * @param string $created//
        * @param string $changed//
        * @return ObjectsCleans    */
    public static function create($id, $user_id, $code, $color, $name, $note, $on_arival, $on_departure, $created, $changed): ObjectsCleans
    {
        $objectsCleans = new static();
                $objectsCleans->id = $id;
                $objectsCleans->user_id = $user_id;
                $objectsCleans->code = $code;
                $objectsCleans->color = $color;
                $objectsCleans->name = $name;
                $objectsCleans->note = $note;
                $objectsCleans->on_arival = $on_arival;
                $objectsCleans->on_departure = $on_departure;
                $objectsCleans->created = $created;
                $objectsCleans->changed = $changed;
        
        return $objectsCleans;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $color//
            * @param string $name//
            * @param string $note//
            * @param string $on_arival// put this status on arival (auto job)
            * @param string $on_departure// put this status on departure (auto job)
            * @param string $created//
            * @param string $changed//
        * @return ObjectsCleans    */
    public function edit($id, $user_id, $code, $color, $name, $note, $on_arival, $on_departure, $created, $changed): ObjectsCleans
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
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsMaintenances()
    {
        return $this->hasMany(ObjectsMaintenance::class, ['clean_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsCleansQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsCleansQuery(get_called_class());
    }
}
