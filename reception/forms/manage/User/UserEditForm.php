<?php

namespace reception\forms\manage\User;

use reception\entities\User\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserEditForm extends Model
{
    public $username;
    public $email;
    public $id;
   // public $phone;
    public $role;
    public $existRoles=[];

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->id = $user->id;
        $this->existRoles = $this->userRolesList();
       // $this->phone = $user->phone;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        $this->role = $roles ? reset($roles)->name : null;
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'email', 'role'], 'required'],
            [['existRoles'],'safe'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['id'], 'integer'],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    }
    public function userRolesList(): array
    {
        $roles=[];
        foreach (Yii::$app->authManager->getRolesByUser($this->id) as $role){
            $roles[]=$role->name;
        }
        return $roles;//ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($this->id), 'name');
    }
}