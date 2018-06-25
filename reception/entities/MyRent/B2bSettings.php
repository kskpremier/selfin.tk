<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "b2b_settings".
 *
 * @property int $id
 * @property int $user_id
 * @property int $b2b_id
 * @property string $name
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Users $user
 */
class B2bSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b2b_settings';
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
        * @param string $name//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return B2bSettings    */
    public static function create($id, $user_id, $b2b_id, $name, $value, $created, $changed): B2bSettings
    {
        $b2bSettings = new static();
                $b2bSettings->id = $id;
                $b2bSettings->user_id = $user_id;
                $b2bSettings->b2b_id = $b2b_id;
                $b2bSettings->name = $name;
                $b2bSettings->value = $value;
                $b2bSettings->created = $created;
                $b2bSettings->changed = $changed;
        
        return $b2bSettings;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $b2b_id//
            * @param string $name//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return B2bSettings    */
    public function edit($id, $user_id, $b2b_id, $name, $value, $created, $changed): B2bSettings
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->b2b_id = $b2b_id;
            $this->name = $name;
            $this->value = $value;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\B2bSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\B2bSettingsQuery(get_called_class());
    }
}
