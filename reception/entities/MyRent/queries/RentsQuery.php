<?php

namespace reception\entities\MyRent\queries;

/**
 * This is the ActiveQuery class for [[\reception\entities\MyRentReception\Rents]].
 *
 * @see \reception\entities\MyRent\Rents
 */
class RentsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['rents.active'=>"Y"]);
    }

    public function checkedIn($date)
    {
        return $this->andWhere( ['and', ['<=',  'rents.from_date', $date], ['>=',  'rents.until_date', $date] ]);//,['rents.check_in'=>"Y"]
    }
    public function forUser($user_id)
    {
        return $this->andWhere(['objects.user_id'=>$user_id]);

    }


//    public function forObject($object)
//    {
//        return $this->andWhere(['rents.object_id'=>$object]);
//    }

    public function withContactData()
    {
        return $this->andWhere(['!=','rents.contact_email',""])->andWhere(['!=','rents.contact_name',""]);
    }
    /**
     * @inheritdoc
     * @return Rents[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Rents|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function forReception($reception)
    {
        return $this->andWhere(['objects.user_id'=>$reception]);

    }

    /**
     * @inheritdoc
     * @return Rents|array|null
     */
    public function forObject($objectId)
    {
        return $this->andWhere(['rents.object_id'=>$objectId]);
    }

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
    private function getUserId($reception)
    {
        switch ($reception) {
            case "Kvarner":
                return 611;
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
            default: return 611;
        }
    }
    public function inInterval($start,$until)
    {
        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
            ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
            ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.until_date',  $start] ],
            ['and', ['>',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.from_date', $until] ]
        ])
            ->andWhere(['rents.active'=>'Y']);
    }

    public function ocupiedInPeriod($start,$until){

    }
}
