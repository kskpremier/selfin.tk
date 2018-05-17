<?php

namespace backend\models;

use reception\entities\User\User;
use Yii;

/**
 * This is the model class for table "superuser".
 *
 * @property int $id
 * @property int $master_user_id
 * @property int $slave_user_id
 *
 * @property Users $masterUser
 * @property Users $slaveUser
 */
class Superuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'superuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_user_id', 'slave_user_id'], 'required'],
            [['master_user_id', 'slave_user_id'], 'integer'],
            [['master_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['master_user_id' => 'id']],
            [['slave_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['slave_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_user_id' => 'Master User ID',
            'slave_user_id' => 'Slave User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterUser()
    {
        return $this->hasOne(User::className(), ['id' => 'master_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlaveUser()
    {
        return $this->hasOne(User::className(), ['id' => 'slave_user_id']);
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\SuperuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\SuperuserQuery(get_called_class());
    }
}
