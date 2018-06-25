<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\SupportTicket;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "support_ticket_messages".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property int $support_ticket_id
 * @property string $type send / recive
 * @property string $readed
 * @property string $message
 * @property string $created
 *
 * @property SupportTickets $supportTicket
 * @property Users $user
 * @property Workers $worker
 */
class SupportTicketMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_ticket_messages';
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
        * @param int $support_ticket_id//
        * @param string $type// send / recive
        * @param string $readed//
        * @param string $message//
        * @param string $created//
        * @return SupportTicketMessages    */
    public static function create($id, $user_id, $worker_id, $support_ticket_id, $type, $readed, $message, $created): SupportTicketMessages
    {
        $supportTicketMessages = new static();
                $supportTicketMessages->id = $id;
                $supportTicketMessages->user_id = $user_id;
                $supportTicketMessages->worker_id = $worker_id;
                $supportTicketMessages->support_ticket_id = $support_ticket_id;
                $supportTicketMessages->type = $type;
                $supportTicketMessages->readed = $readed;
                $supportTicketMessages->message = $message;
                $supportTicketMessages->created = $created;
        
        return $supportTicketMessages;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param int $support_ticket_id//
            * @param string $type// send / recive
            * @param string $readed//
            * @param string $message//
            * @param string $created//
        * @return SupportTicketMessages    */
    public function edit($id, $user_id, $worker_id, $support_ticket_id, $type, $readed, $message, $created): SupportTicketMessages
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->support_ticket_id = $support_ticket_id;
            $this->type = $type;
            $this->readed = $readed;
            $this->message = $message;
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
            'worker_id' => Yii::t('app', 'Worker ID'),
            'support_ticket_id' => Yii::t('app', 'Support Ticket ID'),
            'type' => Yii::t('app', 'Type'),
            'readed' => Yii::t('app', 'Readed'),
            'message' => Yii::t('app', 'Message'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTicket()
    {
        return $this->hasOne(SupportTickets::class, ['id' => 'support_ticket_id']);
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
     * @return \reception\entities\MyRent\queries\SupportTicketMessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\SupportTicketMessagesQuery(get_called_class());
    }
}
