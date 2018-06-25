<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Guest;

/**
 * This is the model class for table "log_guests_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $guest_id
 * @property string $type
 * @property string $link
 * @property string $request_resource
 * @property string $r_status
 * @property string $method
 * @property string $status_code
 * @property string $status_description
 * @property int $runtime ms
 * @property string $header
 * @property string $content
 * @property string $error_message
 * @property string $server
 * @property string $created
 *
 * @property B2b $b2b
 * @property Guests $guest
 */
class LogGuestsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_guests_b2b';
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
        * @param int $b2b_id//
        * @param int $guest_id//
        * @param string $type//
        * @param string $link//
        * @param string $request_resource//
        * @param string $r_status//
        * @param string $method//
        * @param string $status_code//
        * @param string $status_description//
        * @param int $runtime// ms
        * @param string $header//
        * @param string $content//
        * @param string $error_message//
        * @param string $server//
        * @param string $created//
        * @return LogGuestsB2b    */
    public static function create($id, $b2b_id, $guest_id, $type, $link, $request_resource, $r_status, $method, $status_code, $status_description, $runtime, $header, $content, $error_message, $server, $created): LogGuestsB2b
    {
        $logGuestsB2b = new static();
                $logGuestsB2b->id = $id;
                $logGuestsB2b->b2b_id = $b2b_id;
                $logGuestsB2b->guest_id = $guest_id;
                $logGuestsB2b->type = $type;
                $logGuestsB2b->link = $link;
                $logGuestsB2b->request_resource = $request_resource;
                $logGuestsB2b->r_status = $r_status;
                $logGuestsB2b->method = $method;
                $logGuestsB2b->status_code = $status_code;
                $logGuestsB2b->status_description = $status_description;
                $logGuestsB2b->runtime = $runtime;
                $logGuestsB2b->header = $header;
                $logGuestsB2b->content = $content;
                $logGuestsB2b->error_message = $error_message;
                $logGuestsB2b->server = $server;
                $logGuestsB2b->created = $created;
        
        return $logGuestsB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $guest_id//
            * @param string $type//
            * @param string $link//
            * @param string $request_resource//
            * @param string $r_status//
            * @param string $method//
            * @param string $status_code//
            * @param string $status_description//
            * @param int $runtime// ms
            * @param string $header//
            * @param string $content//
            * @param string $error_message//
            * @param string $server//
            * @param string $created//
        * @return LogGuestsB2b    */
    public function edit($id, $b2b_id, $guest_id, $type, $link, $request_resource, $r_status, $method, $status_code, $status_description, $runtime, $header, $content, $error_message, $server, $created): LogGuestsB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->guest_id = $guest_id;
            $this->type = $type;
            $this->link = $link;
            $this->request_resource = $request_resource;
            $this->r_status = $r_status;
            $this->method = $method;
            $this->status_code = $status_code;
            $this->status_description = $status_description;
            $this->runtime = $runtime;
            $this->header = $header;
            $this->content = $content;
            $this->error_message = $error_message;
            $this->server = $server;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'guest_id' => Yii::t('app', 'Guest ID'),
            'type' => Yii::t('app', 'Type'),
            'link' => Yii::t('app', 'Link'),
            'request_resource' => Yii::t('app', 'Request Resource'),
            'r_status' => Yii::t('app', 'R Status'),
            'method' => Yii::t('app', 'Method'),
            'status_code' => Yii::t('app', 'Status Code'),
            'status_description' => Yii::t('app', 'Status Description'),
            'runtime' => Yii::t('app', 'Runtime'),
            'header' => Yii::t('app', 'Header'),
            'content' => Yii::t('app', 'Content'),
            'error_message' => Yii::t('app', 'Error Message'),
            'server' => Yii::t('app', 'Server'),
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
    public function getGuest()
    {
        return $this->hasOne(Guests::class, ['id' => 'guest_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogGuestsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogGuestsB2bQuery(get_called_class());
    }
}
