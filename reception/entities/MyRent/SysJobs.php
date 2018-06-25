<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\RentsStatuses;

/**
 * This is the model class for table "sys_jobs".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string $description
 * @property string $par1
 * @property string $par2
 * @property string $sql1
 * @property string $sql2
 * @property string $created
 * @property string $changed
 *
 * @property RentsStatus[] $rentsStatuses
 */
class SysJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_jobs';
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
        * @param string $name//
        * @param int $user_id//
        * @param string $description//
        * @param string $par1//
        * @param string $par2//
        * @param string $sql1//
        * @param string $sql2//
        * @param string $created//
        * @param string $changed//
        * @return SysJobs    */
    public static function create($id, $name, $user_id, $description, $par1, $par2, $sql1, $sql2, $created, $changed): SysJobs
    {
        $sysJobs = new static();
                $sysJobs->id = $id;
                $sysJobs->name = $name;
                $sysJobs->user_id = $user_id;
                $sysJobs->description = $description;
                $sysJobs->par1 = $par1;
                $sysJobs->par2 = $par2;
                $sysJobs->sql1 = $sql1;
                $sysJobs->sql2 = $sql2;
                $sysJobs->created = $created;
                $sysJobs->changed = $changed;
        
        return $sysJobs;
    }

    /**
            * @param int $id//
            * @param string $name//
            * @param int $user_id//
            * @param string $description//
            * @param string $par1//
            * @param string $par2//
            * @param string $sql1//
            * @param string $sql2//
            * @param string $created//
            * @param string $changed//
        * @return SysJobs    */
    public function edit($id, $name, $user_id, $description, $par1, $par2, $sql1, $sql2, $created, $changed): SysJobs
    {

            $this->id = $id;
            $this->name = $name;
            $this->user_id = $user_id;
            $this->description = $description;
            $this->par1 = $par1;
            $this->par2 = $par2;
            $this->sql1 = $sql1;
            $this->sql2 = $sql2;
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
            'name' => Yii::t('app', 'Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'description' => Yii::t('app', 'Description'),
            'par1' => Yii::t('app', 'Par1'),
            'par2' => Yii::t('app', 'Par2'),
            'sql1' => Yii::t('app', 'Sql1'),
            'sql2' => Yii::t('app', 'Sql2'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsStatuses()
    {
        return $this->hasMany(RentsStatus::class, ['sys_job_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\SysJobsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\SysJobsQuery(get_called_class());
    }
}
