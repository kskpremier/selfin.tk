<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "guest".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $contact_email
 * @property integer $application_id
 * @property integer $user_id
 * @property integer $document_id
 *
 * @property Booking[] $bookings
 * @property Application $application
 * @property Document $document
 */
class Guest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id','user_id'], 'integer'],

            [['first_name', 'second_name'], 'string', 'max' => 32],
            [['contact_email'], 'string', 'max' => 255],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
//            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'contact_email' => 'Contact Email',
            'application_id' => 'Application ID',
            'document_id' => 'Document ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id' => 'booking_id'])->viaTable('{{%booking_guest}}', ['guest_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }
}
