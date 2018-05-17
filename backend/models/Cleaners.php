<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cleaners".
 *
 * @property int $id
 * @property int $user_id
 * @property string $guid
 * @property string $color
 * @property string $code
 * @property string $name
 * @property string $tel
 * @property string $email
 * @property string $note
 * @property string $details_extra show extra details of reservation
 * @property string $list_details_closed show list closed
 * @property string $extra_notes show extra notes in mobile applciation
 * @property string $created
 * @property string $changed
 *
 * @property Objects[] $objects
 * @property Rents[] $rents
 */
class Cleaners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cleaners';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRentLocal');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['note', 'details_extra', 'list_details_closed', 'extra_notes'], 'string'],
            [['created', 'changed'], 'safe'],
            [['guid', 'color', 'code', 'name', 'tel', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'guid' => 'Guid',
            'color' => 'Color',
            'code' => 'Code',
            'name' => 'Name',
            'tel' => 'Tel',
            'email' => 'Email',
            'note' => 'Note',
            'details_extra' => 'Details Extra',
            'list_details_closed' => 'List Details Closed',
            'extra_notes' => 'Extra Notes',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['cleaner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['cleaner_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CleanersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CleanersQuery(get_called_class());
    }
}
