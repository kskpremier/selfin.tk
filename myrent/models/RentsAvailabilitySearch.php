<?php

namespace myrent\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use myrent\models\Rents;

/**
 * RentsSearch represents the model behind the search form of `myrent\models\Rents`.
 */
class RentsAvailabilitySearch extends Objects
{
    public $searchString;
    public $userIds;

    public $object;
    public $reception;
    public $start;
    public $until;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['searchString','name'],'string'],
            [['userIds','start','until','reception'],'safe']
        ];
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $objectsList=[];
        $query = Objects::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
         if (!$this->validate()){
             return  $dataProvider;
         }
        $query->andFilterWhere(['like','objects.name',$this->name]);
        $query->joinWith('rents');
        $query->joinWith('rents.rentsStatus');
        $query->joinWith('rents.currency');
        $query->joinWith('rents.country');
//        $query->joinWith('rents.country');
        $query->joinWith('unit');
        $query->forReception($this->reception);
        $query->notFullOccupied($this->start,$this->until,$this->userIds);

        return $dataProvider;
    }
}
