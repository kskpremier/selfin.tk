<?php

namespace common\rbac\rules;

use yii\base\InvalidCallException;
use yii\rbac\Rule;

class PropertyOwnerRule extends Rule
{
    public $name = 'propertyOwner';
    //если пользователь является собственником или управляющим апартаментов, то он может менять параметры замка
    //если пользователь имеет роль администратора - то он может менять параметры замкаб удалять его и проч
    public function execute($userId, $item, $params)
    {
        if (empty($params['doorlock'])) {
            throw new InvalidCallException('Specify post.');
        }

        return true; //пока разрешим всем пользователям
        //return $params['doorlock']->user_id == $userId;
    }
}