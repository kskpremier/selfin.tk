<?php

namespace backend\models\query;
use reception\entities\User\User;
use yii\helpers\ArrayHelper;


/**
 * This is the ActiveQuery class for [[Objects]].
 *
 * @see Objects
 */
class DoorLockQuery extends \yii\db\ActiveQuery
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
        $users = User::find()->where(['id'=>$userIds])->all();
        if ($users) {
            $listIds = (is_array($userIds))? $userIds: [$userIds];
            foreach ($users as $user) {
                $parents = ArrayHelper::getColumn($user->parentUsers, 'id');
                $listIds = ArrayHelper::merge($listIds, $parents);
            }
            return  $this->joinWith('apartments')->andWhere(['apartment.user_id'=>$listIds])->orWhere(['door_lock.user_id'=>$userIds]);
        }
        return ($userIds)? $this->joinWith('apartments')->andWhere(['apartment.user_id'=>$userIds])->orWhere(['door_lock.user_id'=>$userIds]) : $this->andWhere('1=1');
    }

    /**
     * @inheritdoc
     * @return Rents|array|null
     */
    public function forReception($reception)
    {
        if (!$reception) return $this->andWhere(['objects.user_id'=>[606,607,608,609,610,611,612]]);
        return $this->andWhere(['objects.user_id'=>$reception]);
    }


    public function forPeriod($start,$until)
    {
        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
            ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
            ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.from_date',  $start] ],
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.until_date', $until] ]
        ]);
    }


}
