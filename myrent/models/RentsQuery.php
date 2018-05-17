<?php

namespace myrent\models;

/**
 * This is the ActiveQuery class for [[Rents]].
 *
 * @see Rents
 */
class RentsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['rents.active'=>"Y"]);
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

    /**
     * @inheritdoc
     * @return Rents|array|null
     */
    public function forReception($reception)
    {
        return $this->andWhere(['user_id'=>$this->getUserId($reception)]);
    }

    /**
     * @inheritdoc
     * @return Rents|array|null
     */
    public function forObject($objectId)
    {
        return $this->andWhere(['object_id'=>$objectId]);
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
            default: return 612;
        }
    }
    public function inInterval($start,$until)
    {
        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
            ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
            ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.from_date',  $start] ],
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.until_date', $until] ]
        ])
                    ->andWhere(['rents.active'=>'Y']);
    }

    public function ocupiedInPeriod($start,$until){

    }
}
