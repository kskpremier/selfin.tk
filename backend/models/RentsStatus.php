<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rents_status".
 *
 * @property int $id
 * @property int $user_id
 * @property int $sys_job_id
 * @property int $status_before_id
 * @property string $code
 * @property string $name
 * @property string $note
 * @property string $color
 * @property string $color_font
 * @property int $email_template_id
 * @property string $reservation if status is doing reservation of the dates
 * @property string $show_unit_details show unit details in guest portal, name, tel, email
 * @property int $status_ord sorting statuses
 * @property string $created
 * @property string $changed
 *
 * @property Rents[] $rents
 * @property SysJobs $sysJob
 * @property RentsStatus $statusBefore
 * @property RentsStatus[] $rentsStatuses
 */
class RentsStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rents_status';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRentLocal');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sys_job_id', 'status_before_id', 'email_template_id', 'status_ord'], 'integer'],
            [['note', 'reservation', 'show_unit_details'], 'string'],
            [['created', 'changed'], 'safe'],
            [['code', 'name', 'color', 'color_font'], 'string', 'max' => 50],
            [['sys_job_id'], 'exist', 'skipOnError' => true, 'targetClass' => SysJobs::className(), 'targetAttribute' => ['sys_job_id' => 'id']],
            [['status_before_id'], 'exist', 'skipOnError' => true, 'targetClass' => RentsStatus::className(), 'targetAttribute' => ['status_before_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sys_job_id' => 'Sys Job ID',
            'status_before_id' => 'Status Before ID',
            'code' => 'Code',
            'name' => 'Name',
            'note' => 'Note',
            'color' => 'Color',
            'color_font' => 'Color Font',
            'email_template_id' => 'Email Template ID',
            'reservation' => 'Reservation',
            'show_unit_details' => 'Show Unit Details',
            'status_ord' => 'Status Ord',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['rent_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysJob()
    {
        return $this->hasOne(SysJobs::className(), ['id' => 'sys_job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusBefore()
    {
        return $this->hasOne(RentsStatus::className(), ['id' => 'status_before_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsStatuses()
    {
        return $this->hasMany(RentsStatus::className(), ['status_before_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RentsStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RentsStatusQuery(get_called_class());
    }
}
