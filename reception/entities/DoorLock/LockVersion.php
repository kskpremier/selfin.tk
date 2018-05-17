<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 7:29
 */
namespace reception\entities\DoorLock;

use yii\db\ActiveRecord;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * @property integer $scene
 * @property integer $doorLockId
 * @property integer $protocol_type
 * @property integer $protocol_version
 * @property integer $org_id
 * @property integer $group_id
 * @property integer $door_lock_id

 */
class LockVersion extends ActiveRecord
{
    public static function create($protocolType,$protocolVersion,$scene,$groupId,$orgId)//,$doorLockId)
    {
        $lockVersion = new static();
        $lockVersion->group_id = $groupId;
        $lockVersion->protocol_version = $protocolVersion;
        $lockVersion->protocol_type = $protocolType;
        $lockVersion->scene = $scene;
        $lockVersion->org_id = $orgId;
       // $lockVersion->door_lock_id = $doorLockId;

        return $lockVersion;
    }
    public function edit($protocolType,$protocolVersion,$scene,$groupId,$orgId)
    {
       $this->group_id = $groupId;
       $this->protocol_version = $protocolVersion;
       $this->protocol_type = $protocolType;
       $this->scene = $scene;
       $this->org_id = $orgId;

        return $this;
    }

    public static function tableName(): string
    {
        return '{{%lock_version}}';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['lock_version_id' => 'id']);
    }
//    /**
//     * @inheritdoc
//     */
//    public function behaviors()
//    {
//        return [
//            [
//                'class' => SaveRelationsBehavior::className(),
//                'relations' => ['doorLock'],
//            ],
//        ];
//    }

    public function lockVersionJson(){
        return json_encode([
            'protocolType'=>$this->protocol_type,
            'protocolVersion'=>$this->protocol_version,
            'scene'=>$this->scene,
            'groupId'=>$this->group_id,
            'orgId'=>$this->org_id,
        ]);
    }
}