<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;

/**
 * This is the model class for table "log_api".
 *
 * @property int $id
 * @property int $b2b_id
 * @property string $status
 * @property string $url
 * @property string $query
 * @property string $status_msg
 * @property string $auth
 * @property string $body
 * @property string $proces
 * @property string $proces_note
 * @property double $proces_time
 * @property string $proces_finish
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 */
class LogApi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_api';
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
        * @param string $status//
        * @param string $url//
        * @param string $query//
        * @param string $status_msg//
        * @param string $auth//
        * @param string $body//
        * @param string $proces//
        * @param string $proces_note//
        * @param double $proces_time//
        * @param string $proces_finish//
        * @param string $created//
        * @param string $changed//
        * @return LogApi    */
    public static function create($id, $b2b_id, $status, $url, $query, $status_msg, $auth, $body, $proces, $proces_note, $proces_time, $proces_finish, $created, $changed): LogApi
    {
        $logApi = new static();
                $logApi->id = $id;
                $logApi->b2b_id = $b2b_id;
                $logApi->status = $status;
                $logApi->url = $url;
                $logApi->query = $query;
                $logApi->status_msg = $status_msg;
                $logApi->auth = $auth;
                $logApi->body = $body;
                $logApi->proces = $proces;
                $logApi->proces_note = $proces_note;
                $logApi->proces_time = $proces_time;
                $logApi->proces_finish = $proces_finish;
                $logApi->created = $created;
                $logApi->changed = $changed;
        
        return $logApi;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param string $status//
            * @param string $url//
            * @param string $query//
            * @param string $status_msg//
            * @param string $auth//
            * @param string $body//
            * @param string $proces//
            * @param string $proces_note//
            * @param double $proces_time//
            * @param string $proces_finish//
            * @param string $created//
            * @param string $changed//
        * @return LogApi    */
    public function edit($id, $b2b_id, $status, $url, $query, $status_msg, $auth, $body, $proces, $proces_note, $proces_time, $proces_finish, $created, $changed): LogApi
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->status = $status;
            $this->url = $url;
            $this->query = $query;
            $this->status_msg = $status_msg;
            $this->auth = $auth;
            $this->body = $body;
            $this->proces = $proces;
            $this->proces_note = $proces_note;
            $this->proces_time = $proces_time;
            $this->proces_finish = $proces_finish;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'status' => Yii::t('app', 'Status'),
            'url' => Yii::t('app', 'Url'),
            'query' => Yii::t('app', 'Query'),
            'status_msg' => Yii::t('app', 'Status Msg'),
            'auth' => Yii::t('app', 'Auth'),
            'body' => Yii::t('app', 'Body'),
            'proces' => Yii::t('app', 'Proces'),
            'proces_note' => Yii::t('app', 'Proces Note'),
            'proces_time' => Yii::t('app', 'Proces Time'),
            'proces_finish' => Yii::t('app', 'Proces Finish'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
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
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LogApiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LogApiQuery(get_called_class());
    }
}
