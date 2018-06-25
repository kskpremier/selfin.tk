<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;
use reception\entities\MyRent\Units;

/**
 * This is the model class for table "offices".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id main worker
 * @property string $code
 * @property string $code_fis code for fiscalization
 * @property string $name
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 * @property Workers $worker
 * @property Units[] $units
 */
class Offices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offices';
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
        * @param int $worker_id// main worker
        * @param string $code//
        * @param string $code_fis// code for fiscalization
        * @param string $name//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return Offices    */
    public static function create($id, $user_id, $worker_id, $code, $code_fis, $name, $active, $created, $changed): Offices
    {
        $offices = new static();
                $offices->id = $id;
                $offices->user_id = $user_id;
                $offices->worker_id = $worker_id;
                $offices->code = $code;
                $offices->code_fis = $code_fis;
                $offices->name = $name;
                $offices->active = $active;
                $offices->created = $created;
                $offices->changed = $changed;
        
        return $offices;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id// main worker
            * @param string $code//
            * @param string $code_fis// code for fiscalization
            * @param string $name//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return Offices    */
    public function edit($id, $user_id, $worker_id, $code, $code_fis, $name, $active, $created, $changed): Offices
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->code = $code;
            $this->code_fis = $code_fis;
            $this->name = $name;
            $this->active = $active;
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
            'worker_id' => Yii::t('app', 'Worker ID'),
            'code' => Yii::t('app', 'Code'),
            'code_fis' => Yii::t('app', 'Code Fis'),
            'name' => Yii::t('app', 'Name'),
            'active' => Yii::t('app', 'Active'),
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
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::class, ['office_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\OfficesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\OfficesQuery(get_called_class());
    }
}
