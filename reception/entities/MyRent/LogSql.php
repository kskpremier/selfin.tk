<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "log_sql".
 *
 * @property int $id
 * @property int $user_id
 * @property string $s_sql
 * @property double $s_runtime
 * @property string $created
 *
 * @property Users $user
 */
class LogSql extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_sql';
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
        * @param string $s_sql//
        * @param double $s_runtime//
        * @param string $created//
        * @return LogSql    */
    public static function create($id, $user_id, $s_sql, $s_runtime, $created): LogSql
    {
        $logSql = new static();
                $logSql->id = $id;
                $logSql->user_id = $user_id;
                $logSql->s_sql = $s_sql;
                $logSql->s_runtime = $s_runtime;
                $logSql->created = $created;
        
        return $logSql;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $s_sql//
            * @param double $s_runtime//
            * @param string $created//
        * @return LogSql    */
    public function edit($id, $user_id, $s_sql, $s_runtime, $created): LogSql
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->s_sql = $s_sql;
            $this->s_runtime = $s_runtime;
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
            'user_id' => Yii::t('app', 'User ID'),
            's_sql' => Yii::t('app', 'S Sql'),
            's_runtime' => Yii::t('app', 'S Runtime'),
            'created' => Yii::t('app', 'Created'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogSqlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogSqlQuery(get_called_class());
    }
}
