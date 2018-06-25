<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "rents_cleaning".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property int $worker_id
 * @property string $date
 * @property string $time
 * @property string $note
 * @property string $type
 * @property string $subject
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class RentsCleaning extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_cleaning';
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
        * @param int $rent_id//
        * @param int $worker_id//
        * @param string $date//
        * @param string $time//
        * @param string $note//
        * @param string $type//
        * @param string $subject//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return RentsCleaning    */
    public static function create($id, $user_id, $rent_id, $worker_id, $date, $time, $note, $type, $subject, $active, $created, $changed): RentsCleaning
    {
        $rentsCleaning = new static();
                $rentsCleaning->id = $id;
                $rentsCleaning->user_id = $user_id;
                $rentsCleaning->rent_id = $rent_id;
                $rentsCleaning->worker_id = $worker_id;
                $rentsCleaning->date = $date;
                $rentsCleaning->time = $time;
                $rentsCleaning->note = $note;
                $rentsCleaning->type = $type;
                $rentsCleaning->subject = $subject;
                $rentsCleaning->active = $active;
                $rentsCleaning->created = $created;
                $rentsCleaning->changed = $changed;
        
        return $rentsCleaning;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param int $worker_id//
            * @param string $date//
            * @param string $time//
            * @param string $note//
            * @param string $type//
            * @param string $subject//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return RentsCleaning    */
    public function edit($id, $user_id, $rent_id, $worker_id, $date, $time, $note, $type, $subject, $active, $created, $changed): RentsCleaning
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->worker_id = $worker_id;
            $this->date = $date;
            $this->time = $time;
            $this->note = $note;
            $this->type = $type;
            $this->subject = $subject;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'worker_id' => Yii::t('app', 'Worker ID'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
            'note' => Yii::t('app', 'Note'),
            'type' => Yii::t('app', 'Type'),
            'subject' => Yii::t('app', 'Subject'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsCleaningQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsCleaningQuery(get_called_class());
    }
}
