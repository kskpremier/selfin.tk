<?php

namespace reception\entities\MyRent\queries;
use reception\forms\MyRent\Rents;
use reception\helpers\MyRent\AvailabilityHelper;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\Objects]].
 *
 * @see \reception\entities\MyRent\Objects
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

    public function active()
    {
        return $this->andWhere(['active'=>"Y"]);
    }

    public function withUnit() {
        return $this->andWhere(['not',['unit_id'=>null]]);
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
                ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.until_date',  $start] ],
                ['and', ['>',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.from_date', $until] ]
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
        if (!$reception || $reception == '')
            return $this->andFilterWhere(['objects.user_id'=>[606,607,608,609,610,611,612]]);
        return $this->andFilterWhere(['objects.user_id'=>$reception]);
    }

    private function getUserId($reception) {
        if (!$reception) return [606,607,608,609,610,611,612];
        switch ($reception){
            case "Kvarner":
                return 611 ;
            case "Gajac":
                return 610;
            case "Cervar":
                return 607;
            case "Savudrija":
                return 612;
            case "Zaglav":
                return 609;
            case "Barbariga":
                return 608;
            case "Mareda":
                return 606;
            default:
                return [606,607,608,609,610,611,612];
        }
    }

//    public function availabilityCalc($start,$until)
//    {
//        $subquery=$this->select()->joinWith("rents")->joinWitn("units")
//
//        $query = $this->select("TO_DAYS('2018-06-15') - TO_DAYS('2018-05-29') as Period,
//        ( LEAST(TO_DAYS(`rents`.`until_date`), TO_DAYS('2018-06-15') ) - GREATEST ( TO_DAYS(`rents`.`from_date`),TO_DAYS('2018-05-29') ) ) as Intersection")->orderBy(['Intersection' => SORT_DESC]);
//    }
    public function forPeriod($start,$until)
    {
        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
            ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
            ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.until_date',  $start] ],
            ['and', ['>',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.from_date', $until] ]
        ]);
    }
}
