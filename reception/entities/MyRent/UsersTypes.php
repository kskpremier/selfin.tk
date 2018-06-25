<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "users_types".
 *
 * @property int $id
 * @property string $name
 * @property string $created
 * @property string $changed
 */
class UsersTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_types';
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
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return UsersTypes    */
    public static function create($id, $name, $created, $changed): UsersTypes
    {
        $usersTypes = new static();
                $usersTypes->id = $id;
                $usersTypes->name = $name;
                $usersTypes->created = $created;
                $usersTypes->changed = $changed;
        
        return $usersTypes;
    }

    /**
            * @param int $id//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return UsersTypes    */
    public function edit($id, $name, $created, $changed): UsersTypes
    {

            $this->id = $id;
            $this->name = $name;
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
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersTypesQuery(get_called_class());
    }
}
