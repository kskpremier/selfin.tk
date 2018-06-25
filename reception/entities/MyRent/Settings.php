<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $value
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
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
        * @param string $name//
        * @param string $value//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return Settings    */
    public static function create($id, $user_id, $name, $value, $note, $created, $changed): Settings
    {
        $settings = new static();
                $settings->id = $id;
                $settings->user_id = $user_id;
                $settings->name = $name;
                $settings->value = $value;
                $settings->note = $note;
                $settings->created = $created;
                $settings->changed = $changed;
        
        return $settings;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $name//
            * @param string $value//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return Settings    */
    public function edit($id, $user_id, $name, $value, $note, $created, $changed): Settings
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->name = $name;
            $this->value = $value;
            $this->note = $note;
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
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
     * @return \reception\entities\MyRent\queries\SettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\SettingsQuery(get_called_class());
    }
}
