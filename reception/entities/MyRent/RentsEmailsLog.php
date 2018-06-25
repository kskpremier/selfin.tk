<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\LogEmail;
use reception\entities\MyRent\Rent;

/**
 * This is the model class for table "rents_emails_log".
 *
 * @property int $id
 * @property int $rent_id
 * @property int $log_email_id
 * @property string $created
 * @property string $changed
 *
 * @property LogEmail $logEmail
 * @property Rents $rent
 */
class RentsEmailsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_emails_log';
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
        * @param int $rent_id//
        * @param int $log_email_id//
        * @param string $created//
        * @param string $changed//
        * @return RentsEmailsLog    */
    public static function create($id, $rent_id, $log_email_id, $created, $changed): RentsEmailsLog
    {
        $rentsEmailsLog = new static();
                $rentsEmailsLog->id = $id;
                $rentsEmailsLog->rent_id = $rent_id;
                $rentsEmailsLog->log_email_id = $log_email_id;
                $rentsEmailsLog->created = $created;
                $rentsEmailsLog->changed = $changed;
        
        return $rentsEmailsLog;
    }

    /**
            * @param int $id//
            * @param int $rent_id//
            * @param int $log_email_id//
            * @param string $created//
            * @param string $changed//
        * @return RentsEmailsLog    */
    public function edit($id, $rent_id, $log_email_id, $created, $changed): RentsEmailsLog
    {

            $this->id = $id;
            $this->rent_id = $rent_id;
            $this->log_email_id = $log_email_id;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'log_email_id' => Yii::t('app', 'Log Email ID'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogEmail()
    {
        return $this->hasOne(LogEmail::class, ['id' => 'log_email_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsEmailsLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsEmailsLogQuery(get_called_class());
    }
}
