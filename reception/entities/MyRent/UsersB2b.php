<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\ObjectsEvisitors;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\File0;
use reception\entities\MyRent\Users;

/**
 * This is the model class for table "users_b2b".
 *
 * @property int $id
 * @property int $users_id
 * @property int $b2b_id
 * @property int $file
 * @property string $link1
 * @property string $link2
 * @property string $username
 * @property string $password
 * @property string $option1
 * @property string $option2
 * @property string $option3
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property ObjectsEvisitor[] $objectsEvisitors
 * @property B2b $b2b
 * @property Files $file0
 * @property Users $users
 */
class UsersB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_b2b';
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
        * @param int $users_id//
        * @param int $b2b_id//
        * @param int $file//
        * @param string $link1//
        * @param string $link2//
        * @param string $username//
        * @param string $password//
        * @param string $option1//
        * @param string $option2//
        * @param string $option3//
        * @param string $enable//
        * @param string $created//
        * @param string $changed//
        * @return UsersB2b    */
    public static function create($id, $users_id, $b2b_id, $file, $link1, $link2, $username, $password, $option1, $option2, $option3, $enable, $created, $changed): UsersB2b
    {
        $usersB2b = new static();
                $usersB2b->id = $id;
                $usersB2b->users_id = $users_id;
                $usersB2b->b2b_id = $b2b_id;
                $usersB2b->file = $file;
                $usersB2b->link1 = $link1;
                $usersB2b->link2 = $link2;
                $usersB2b->username = $username;
                $usersB2b->password = $password;
                $usersB2b->option1 = $option1;
                $usersB2b->option2 = $option2;
                $usersB2b->option3 = $option3;
                $usersB2b->enable = $enable;
                $usersB2b->created = $created;
                $usersB2b->changed = $changed;
        
        return $usersB2b;
    }

    /**
            * @param int $id//
            * @param int $users_id//
            * @param int $b2b_id//
            * @param int $file//
            * @param string $link1//
            * @param string $link2//
            * @param string $username//
            * @param string $password//
            * @param string $option1//
            * @param string $option2//
            * @param string $option3//
            * @param string $enable//
            * @param string $created//
            * @param string $changed//
        * @return UsersB2b    */
    public function edit($id, $users_id, $b2b_id, $file, $link1, $link2, $username, $password, $option1, $option2, $option3, $enable, $created, $changed): UsersB2b
    {

            $this->id = $id;
            $this->users_id = $users_id;
            $this->b2b_id = $b2b_id;
            $this->file = $file;
            $this->link1 = $link1;
            $this->link2 = $link2;
            $this->username = $username;
            $this->password = $password;
            $this->option1 = $option1;
            $this->option2 = $option2;
            $this->option3 = $option3;
            $this->enable = $enable;
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
            'users_id' => Yii::t('app', 'Users ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'file' => Yii::t('app', 'File'),
            'link1' => Yii::t('app', 'Link1'),
            'link2' => Yii::t('app', 'Link2'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'option1' => Yii::t('app', 'Option1'),
            'option2' => Yii::t('app', 'Option2'),
            'option3' => Yii::t('app', 'Option3'),
            'enable' => Yii::t('app', 'Enable'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsEvisitors()
    {
        return $this->hasMany(ObjectsEvisitor::class, ['user_b2b_id' => 'id']);
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
    public function getFile0()
    {
        return $this->hasOne(Files::class, ['id' => 'file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::class, ['id' => 'users_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersB2bQuery(get_called_class());
    }
}
