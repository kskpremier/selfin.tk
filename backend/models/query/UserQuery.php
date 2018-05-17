<?php

namespace backend\query\models;


/**
* This is the ActiveQuery class for [[Objects]].
*
* @see Objects
*/
class UserQuery extends \yii\db\ActiveQuery
{


/**
* @inheritdoc
* @return Objects[]|array
*/
public function all($db = null)
{
return parent::all($db);
}

/**
* @inheritdoc
* @return Objects|array|null
*/
public function one($db = null)
{
return parent::one($db);
}

/**
* @inheritdoc
* @return Objects|array|null
*/
public function forUser($userIds)
{
return $this->andWhere(['user_id'=>$userIds]);
}



}
