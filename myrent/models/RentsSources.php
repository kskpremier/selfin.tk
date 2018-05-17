<?php

namespace myrent\models;

use Yii;

/**
 * This is the model class for table "rents_sources".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property string $color
 * @property string $name
 * @property string $link
 * @property string $link_object
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $external
 * @property string $optional
 * @property string $note
 * @property double $charge_extra price of extra charge
 * @property double $provision provision from OTAs in %
 * @property string $created
 * @property string $changed
 *
 * @property Rents[] $rents
 * @property B2b $b2b
 */
class RentsSources extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rents_sources';
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
            [['user_id', 'b2b_id'], 'integer'],
            [['link_object', 'note'], 'string'],
            [['charge_extra', 'provision'], 'number'],
            [['created', 'changed'], 'safe'],
            [['color', 'name', 'link', 'username', 'password', 'email', 'external', 'optional'], 'string', 'max' => 50],
            [['b2b_id'], 'exist', 'skipOnError' => true, 'targetClass' => B2b::className(), 'targetAttribute' => ['b2b_id' => 'id']],
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
            'b2b_id' => 'B2b ID',
            'color' => 'Color',
            'name' => 'Name',
            'link' => 'Link',
            'link_object' => 'Link Object',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'external' => 'External',
            'optional' => 'Optional',
            'note' => 'Note',
            'charge_extra' => 'Charge Extra',
            'provision' => 'Provision',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::className(), ['rent_source_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::className(), ['id' => 'b2b_id']);
    }

    /**
     * @inheritdoc
     * @return RentsSourcesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RentsSourcesQuery(get_called_class());
    }
}
