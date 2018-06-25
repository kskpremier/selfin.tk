<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "log_b2b".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property int $object_id
 * @property int $rent_id
 * @property string $sts
 * @property string $type
 * @property string $note
 * @property string $url
 * @property string $method
 * @property string $subject short note
 * @property string $request
 * @property string $response
 * @property int $time Time for response in ms
 * @property string $created
 *
 * @property B2b $b2b
 * @property Objects $object
 * @property Rents $rent
 * @property Users $user
 */
class LogB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_b2b';
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
        * @param int $b2b_id//
        * @param int $object_id//
        * @param int $rent_id//
        * @param string $sts//
        * @param string $type//
        * @param string $note//
        * @param string $url//
        * @param string $method//
        * @param string $subject// short note
        * @param string $request//
        * @param string $response//
        * @param int $time// Time for response in ms
        * @param string $created//
        * @return LogB2b    */
    public static function create($id, $user_id, $b2b_id, $object_id, $rent_id, $sts, $type, $note, $url, $method, $subject, $request, $response, $time, $created): LogB2b
    {
        $logB2b = new static();
                $logB2b->id = $id;
                $logB2b->user_id = $user_id;
                $logB2b->b2b_id = $b2b_id;
                $logB2b->object_id = $object_id;
                $logB2b->rent_id = $rent_id;
                $logB2b->sts = $sts;
                $logB2b->type = $type;
                $logB2b->note = $note;
                $logB2b->url = $url;
                $logB2b->method = $method;
                $logB2b->subject = $subject;
                $logB2b->request = $request;
                $logB2b->response = $response;
                $logB2b->time = $time;
                $logB2b->created = $created;
        
        return $logB2b;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param int $object_id//
            * @param int $rent_id//
            * @param string $sts//
            * @param string $type//
            * @param string $note//
            * @param string $url//
            * @param string $method//
            * @param string $subject// short note
            * @param string $request//
            * @param string $response//
            * @param int $time// Time for response in ms
            * @param string $created//
        * @return LogB2b    */
    public function edit($id, $user_id, $b2b_id, $object_id, $rent_id, $sts, $type, $note, $url, $method, $subject, $request, $response, $time, $created): LogB2b
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->object_id = $object_id;
            $this->rent_id = $rent_id;
            $this->sts = $sts;
            $this->type = $type;
            $this->note = $note;
            $this->url = $url;
            $this->method = $method;
            $this->subject = $subject;
            $this->request = $request;
            $this->response = $response;
            $this->time = $time;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'sts' => Yii::t('app', 'Sts'),
            'type' => Yii::t('app', 'Type'),
            'note' => Yii::t('app', 'Note'),
            'url' => Yii::t('app', 'Url'),
            'method' => Yii::t('app', 'Method'),
            'subject' => Yii::t('app', 'Subject'),
            'request' => Yii::t('app', 'Request'),
            'response' => Yii::t('app', 'Response'),
            'time' => Yii::t('app', 'Time'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogB2bQuery(get_called_class());
    }
}
