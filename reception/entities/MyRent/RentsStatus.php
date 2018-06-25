<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsRentsSources;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsSources;
use reception\entities\MyRent\SysJob;
use reception\entities\MyRent\StatusBefore;
use reception\entities\MyRent\RentsStatuses;
use reception\entities\MyRent\User;

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
 * @property string $check_in set this status when check in
 * @property string $check_out set this status when check out
 * @property string $confirm set this status when you confirm rent
 * @property int $status_ord sorting statuses
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsRentsSources[] $objectsRentsSources
 * @property Rents[] $rents
 * @property RentsSources[] $rentsSources
 * @property SysJobs $sysJob
 * @property RentsStatus $statusBefore
 * @property RentsStatus[] $rentsStatuses
 * @property Users $user
 */
class RentsStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $user_id//
        * @param int $sys_job_id//
        * @param int $status_before_id//
        * @param string $code//
        * @param string $name//
        * @param string $note//
        * @param string $color//
        * @param string $color_font//
        * @param int $email_template_id//
        * @param string $reservation// if status is doing reservation of the dates
        * @param string $show_unit_details// show unit details in guest portal, name, tel, email
        * @param string $check_in// set this status when check in
        * @param string $check_out// set this status when check out
        * @param string $confirm// set this status when you confirm rent
        * @param int $status_ord// sorting statuses
        * @param string $created//
        * @param string $changed//
        * @return RentsStatus    */
    public static function create($id, $user_id, $sys_job_id, $status_before_id, $code, $name, $note, $color, $color_font, $email_template_id, $reservation, $show_unit_details, $check_in, $check_out, $confirm, $status_ord, $created, $changed): RentsStatus
    {
        $rentsStatus = new static();
                $rentsStatus->id = $id;
                $rentsStatus->user_id = $user_id;
                $rentsStatus->sys_job_id = $sys_job_id;
                $rentsStatus->status_before_id = $status_before_id;
                $rentsStatus->code = $code;
                $rentsStatus->name = $name;
                $rentsStatus->note = $note;
                $rentsStatus->color = $color;
                $rentsStatus->color_font = $color_font;
                $rentsStatus->email_template_id = $email_template_id;
                $rentsStatus->reservation = $reservation;
                $rentsStatus->show_unit_details = $show_unit_details;
                $rentsStatus->check_in = $check_in;
                $rentsStatus->check_out = $check_out;
                $rentsStatus->confirm = $confirm;
                $rentsStatus->status_ord = $status_ord;
                $rentsStatus->created = $created;
                $rentsStatus->changed = $changed;
        
        return $rentsStatus;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $sys_job_id//
            * @param int $status_before_id//
            * @param string $code//
            * @param string $name//
            * @param string $note//
            * @param string $color//
            * @param string $color_font//
            * @param int $email_template_id//
            * @param string $reservation// if status is doing reservation of the dates
            * @param string $show_unit_details// show unit details in guest portal, name, tel, email
            * @param string $check_in// set this status when check in
            * @param string $check_out// set this status when check out
            * @param string $confirm// set this status when you confirm rent
            * @param int $status_ord// sorting statuses
            * @param string $created//
            * @param string $changed//
        * @return RentsStatus    */
    public function edit($id, $user_id, $sys_job_id, $status_before_id, $code, $name, $note, $color, $color_font, $email_template_id, $reservation, $show_unit_details, $check_in, $check_out, $confirm, $status_ord, $created, $changed): RentsStatus
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->sys_job_id = $sys_job_id;
            $this->status_before_id = $status_before_id;
            $this->code = $code;
            $this->name = $name;
            $this->note = $note;
            $this->color = $color;
            $this->color_font = $color_font;
            $this->email_template_id = $email_template_id;
            $this->reservation = $reservation;
            $this->show_unit_details = $show_unit_details;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->confirm = $confirm;
            $this->status_ord = $status_ord;
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
            'sys_job_id' => Yii::t('app', 'Sys Job ID'),
            'status_before_id' => Yii::t('app', 'Status Before ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'color' => Yii::t('app', 'Color'),
            'color_font' => Yii::t('app', 'Color Font'),
            'email_template_id' => Yii::t('app', 'Email Template ID'),
            'reservation' => Yii::t('app', 'Reservation'),
            'show_unit_details' => Yii::t('app', 'Show Unit Details'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'confirm' => Yii::t('app', 'Confirm'),
            'status_ord' => Yii::t('app', 'Status Ord'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRentsSources()
    {
        return $this->hasMany(ObjectsRentsSources::class, ['rent_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['rent_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsSources()
    {
        return $this->hasMany(RentsSources::class, ['rent_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysJob()
    {
        return $this->hasOne(SysJobs::class, ['id' => 'sys_job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusBefore()
    {
        return $this->hasOne(RentsStatus::class, ['id' => 'status_before_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsStatuses()
    {
        return $this->hasMany(RentsStatus::class, ['status_before_id' => 'id']);
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
     * @return \reception\entities\MyRent\queries\RentsStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsStatusQuery(get_called_class());
    }
}
