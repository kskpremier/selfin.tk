<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property int $worker_id
 * @property string $source
 * @property string $creator
 * @property string $message
 * @property string $seen
 * @property string $seen_date
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 * @property Workers $worker
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
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
        * @param string $source//
        * @param string $creator//
        * @param string $message//
        * @param string $seen//
        * @param string $seen_date//
        * @param string $created//
        * @param string $changed//
        * @return Messages    */
    public static function create($id, $user_id, $rent_id, $worker_id, $source, $creator, $message, $seen, $seen_date, $created, $changed): Messages
    {
        $messages = new static();
                $messages->id = $id;
                $messages->user_id = $user_id;
                $messages->rent_id = $rent_id;
                $messages->worker_id = $worker_id;
                $messages->source = $source;
                $messages->creator = $creator;
                $messages->message = $message;
                $messages->seen = $seen;
                $messages->seen_date = $seen_date;
                $messages->created = $created;
                $messages->changed = $changed;
        
        return $messages;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param int $worker_id//
            * @param string $source//
            * @param string $creator//
            * @param string $message//
            * @param string $seen//
            * @param string $seen_date//
            * @param string $created//
            * @param string $changed//
        * @return Messages    */
    public function edit($id, $user_id, $rent_id, $worker_id, $source, $creator, $message, $seen, $seen_date, $created, $changed): Messages
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->worker_id = $worker_id;
            $this->source = $source;
            $this->creator = $creator;
            $this->message = $message;
            $this->seen = $seen;
            $this->seen_date = $seen_date;
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
            'source' => Yii::t('app', 'Source'),
            'creator' => Yii::t('app', 'Creator'),
            'message' => Yii::t('app', 'Message'),
            'seen' => Yii::t('app', 'Seen'),
            'seen_date' => Yii::t('app', 'Seen Date'),
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
     * @return \reception\entities\MyRent\queries\MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\MessagesQuery(get_called_class());
    }
}
