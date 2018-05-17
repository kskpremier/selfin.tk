<?php

namespace reception\helpers;

use reception\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use reception\services\MyRent\MyRent;
use Yii;

class UserHelper
{
    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active',
        ];
    }
    public static function statusUpdateList(): array
    {
        return [
            false => 'Ok',
            true => ' ',
        ];
    }

    public static function statusName($status): string
    {
        return "Active";
        //return ArrayHelper::getValue(self::statusUpdateList(), $status);
    }

    public static function statusUpdate($needToUpdate): string
    {
        return ArrayHelper::getValue(self::statusList(), $needToUpdate);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case User::STATUS_WAIT:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
    public static function getConnectedUsers($user):array
    {
    $parents = $user->parentUsers;
    $child = $user->dependedUsers;

    return  array_merge($parents,$child);
    }



    public static function getUserRoles($user): array
    {
        $rolesArray = [];
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        foreach($roles as $role){
            $rolesArray[] = ArrayHelper::getValue($role, 'name');
        }
        return $rolesArray;
    }
    public static function getSynchroTime($user){
        $needToUpdate = ($user->myrent_update == null) || (time() - $user->myrent_update > MyRent::MyRent_UPDATE_INTERVAL);
        switch ($needToUpdate) {
            case true:
                $class = 'glyphicon glyphicon-refresh label label-danger';
                break;
            case false:
                $class = 'glyphicon glyphicon-refresh label label-success';
                break;
            default:
                $class = 'btn btn-danger';
        }

        return Html::a(ArrayHelper::getValue(self::statusUpdateList(), $needToUpdate),  ['synchro', 'id' => $user->id], [
            'class' => $class,
        ]);
    }
}