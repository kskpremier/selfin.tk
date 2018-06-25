<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Users;
use reception\entities\MyRent\Workers;

/**
 * This is the model class for table "workers_types".
 *
 * @property int $id
 * @property string $worker_type
 * @property string $name
 * @property string $created
 *
 * @property Users[] $users
 * @property Workers[] $workers
 */
class WorkersTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers_types';
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
        * @param string $worker_type//
        * @param string $name//
        * @param string $created//
        * @return WorkersTypes    */
    public static function create($id, $worker_type, $name, $created): WorkersTypes
    {
        $workersTypes = new static();
                $workersTypes->id = $id;
                $workersTypes->worker_type = $worker_type;
                $workersTypes->name = $name;
                $workersTypes->created = $created;
        
        return $workersTypes;
    }

    /**
            * @param int $id//
            * @param string $worker_type//
            * @param string $name//
            * @param string $created//
        * @return WorkersTypes    */
    public function edit($id, $worker_type, $name, $created): WorkersTypes
    {

            $this->id = $id;
            $this->worker_type = $worker_type;
            $this->name = $name;
            $this->created = $created;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'worker_type' => Yii::t('app', 'Worker Type'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['user_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::class, ['worker_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\WorkersTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\WorkersTypesQuery(get_called_class());
    }
}
