<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\SupportTicketMessages;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "support_tickets".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property string $status
 * @property string $subject
 * @property string $priority
 * @property string $grp
 * @property string $created
 * @property string $changed
 *
 * @property SupportTicketMessages[] $supportTicketMessages
 * @property Users $user
 * @property Workers $worker
 */
class SupportTickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_tickets';
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
        * @param int $worker_id//
        * @param string $status//
        * @param string $subject//
        * @param string $priority//
        * @param string $grp//
        * @param string $created//
        * @param string $changed//
        * @return SupportTickets    */
    public static function create($id, $user_id, $worker_id, $status, $subject, $priority, $grp, $created, $changed): SupportTickets
    {
        $supportTickets = new static();
                $supportTickets->id = $id;
                $supportTickets->user_id = $user_id;
                $supportTickets->worker_id = $worker_id;
                $supportTickets->status = $status;
                $supportTickets->subject = $subject;
                $supportTickets->priority = $priority;
                $supportTickets->grp = $grp;
                $supportTickets->created = $created;
                $supportTickets->changed = $changed;
        
        return $supportTickets;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param string $status//
            * @param string $subject//
            * @param string $priority//
            * @param string $grp//
            * @param string $created//
            * @param string $changed//
        * @return SupportTickets    */
    public function edit($id, $user_id, $worker_id, $status, $subject, $priority, $grp, $created, $changed): SupportTickets
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->status = $status;
            $this->subject = $subject;
            $this->priority = $priority;
            $this->grp = $grp;
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
            'status' => Yii::t('app', 'Status'),
            'subject' => Yii::t('app', 'Subject'),
            'priority' => Yii::t('app', 'Priority'),
            'grp' => Yii::t('app', 'Grp'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTicketMessages()
    {
        return $this->hasMany(SupportTicketMessages::class, ['support_ticket_id' => 'id']);
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
     * @return \reception\entities\MyRent\queries\SupportTicketsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\SupportTicketsQuery(get_called_class());
    }
}
