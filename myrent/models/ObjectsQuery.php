<?php

namespace myrent\models;
use myrent\helpers\AvailabilityHelper;
use const SORT_ASC;


/**
 * This is the ActiveQuery class for [[Objects]].
 *
 * @see Objects
 */
class ObjectsQuery extends \yii\db\ActiveQuery
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
    public function forUsers($userIds)
    {
        return $this->andWhere(['user_id'=>$userIds]);
    }

    /**
     * @inheritdoc
     * @return Objects|array|null
     */
    public function notFullOccupied($start, $until, $userIds)
    {
        //получаем все букинги за период
        $rentsQuery = Rents::find()->select('rents.from_date, rents.until_date, rents.id, rents.object_id ')
            ->leftJoin('objects', 'objects.id = rents.object_id')->andwhere(['objects.user_id' => $userIds])
            ->andFilterWhere([
                'or',
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
            ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
            ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.from_date',  $start] ],
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.until_date', $until] ]
            ])
            ->active()
            ->orderBy(['objects.id' => SORT_ASC, 'rents.from_date' => SORT_ASC]);
        //получаем занятые апартаменты
        $bookedObjectIDs = AvailabilityHelper::getAvailabilityIDs($rentsQuery->asArray()->all(), $start, $until);

        return  $this->andWhere(['not in','objects.id',$bookedObjectIDs]);
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

    private function getUserId($reception) {
        if (!$reception) return [606,607,608,609,610,611,612];
        switch ($reception){
            case "Kvarner":
                return 611 ;
            case "Gajac":
                return 607;
            case "Cervar":
                return 610;
            case "Savudrija":
                return 606;
            case "Zaglav":
                return 608;
            case "Barbariga":
                return 609;
            case "Mareda":
                return 612;
            default:
                return [606,607,608,609,610,611,612];
        }
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
