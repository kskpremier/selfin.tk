<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 17.05.17
 * Time: 17:16
 */


namespace common\rbac\rules;

use yii\base\InvalidCallException;
use yii\rbac\Rule;

class TouristRule extends Rule
{
    public $name = 'touristRule';

    public function execute($userId, $item, $params)
    {
        if (empty($params['user'])) {
            throw new InvalidCallException('Specify user.');
        }

        return $params['user']->id == $userId;
    }
}