<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lock_version".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $protocol_version
 * @property integer $protocol_type
 * @property integer $org_idd
 * @property string $logo_url
 * @property integer $scene

 *
 * @property DoorLock $doorLock
 */
class LockVersion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lock_version';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'protocol_version', 'protocol_type', 'org_idd', 'scene', 'door_lock_id'], 'integer'],
            [['logo_url'], 'string', 'max' => 16],
           // [['door_lock_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['door_lock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'protocol_version' => Yii::t('app', 'Protocol Version'),
            'protocol_type' => Yii::t('app', 'Protocol Type'),
            'org_idd' => Yii::t('app', 'Org Idd'),
            'logo_url' => Yii::t('app', 'Logo Url'),
            'scene' => Yii::t('app', 'Scene'),
           // 'door_lock_id' => Yii::t('app', 'Door Lock ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['lock_version_id' => 'id']);
    }
    /**
     * create new LockVersion AR from parameters
     * @params string $lockVersionJsonString
     * @return \yii\db\ActiveQuery or false
     */
    public static function addNewDoorLockVersion($lockVersionJsonString)
    {
        if (is_array($doorLockVersion = \GuzzleHttp\json_decode($lockVersionJsonString, true))) {

            $LockVersion = \backend\models\LockVersion::find()->where([
                'group_id' => $doorLockVersion['group_id'],
                'protocol_version' => $doorLockVersion - ['protocol_version'],
                'protocol_type' => $doorLockVersion['protocol_type'],
                'org_idd' => $doorLockVersion['org_idd'],
                'logo_url' => $doorLockVersion['logo_url'],
                'scene' => $doorLockVersion['scene'],
                ])->one();
            }
            if (!$LockVersion) {
                $lockVersion = new \backend\models\LockVersion ([
                    'group_id' => $doorLockVersion['group_id'],
                    'protocol_version' => $doorLockVersion - ['protocol_version'],
                    'protocol_type' => $doorLockVersion['protocol_type'],
                    'org_idd' => $doorLockVersion['org_idd'],
                    'logo_url' => $doorLockVersion['logo_url'],
                    'scene' => $doorLockVersion['scene'],
                ]);
            }
            if (!$LockVersion) {
                throw new ServerException('Can not add LockVersion with this parameters.');
            }
            return ($lockVersion->save())?$lockVersion:false;
    }

}
