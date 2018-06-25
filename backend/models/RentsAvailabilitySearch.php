<?php

namespace backend\models;

use function is_array;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rents;
use backend\models\Objectss;

/**
 * RentsSearch represents the model behind the search form of `backend\models\Rents`.
 */
class RentsAvailabilitySearch extends Objects
{
    public $searchString;
    public $userIds;

    public $object;
    public $reception;
    public $start;
    public $until;
    public $property;
    public $occupancy;
    public $filterName;
    public $items;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['searchString','name'],'string'],
            [['occupancy'],'integer'],
            [['userIds','start','until','reception','property','filterName','items'],'safe']
        ];
    }

//    public function validateDates() {
//
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params=null)
    {
//        $objectsList=[];
        $query = Objects::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params,'RentsAvailabilitySearch');
         if (!$this->validate()){
             return  $dataProvider;
         }
//        $query->availabilityCalc($this->start,$this->until);
//        if(is_array($this->name)){
//
//            $query->andFilterWhere(['like','objects.id',$this->name]);
//
//        }
        $query->andFilterWhere(['like','objects.id',$this->name]);
         if ($this->property!=''&& $this->property!=null)
                $query->andFilterWhere(['objects.id'=>$this->property]);
        $query->joinWith('rents');
        $query->joinWith('rents.rentsStatus');
        $query->joinWith('rents.currency');
        $query->joinWith('rents.country');
        $query->joinWith('pictures');

//        $query->joinWith('rents.country');
        $query->joinWith('unit');
        if (count($this->items)>0) {
            $query->andFilterWhere(['objects.id' => $this->items]);
        }
        else {
            $query->limit(0);
        }
        $query->forReception($this->reception);
        if ($this->filterName ) {
            if (is_array($this->filterName)) {
                $list = [];
                foreach ($this->filterName as $key => $value) {
                    $filter = Filters::findOne($value);
                    $array = unserialize($filter->ids);
                    $list = array_merge($list, array_values($array));
                }
            $query->andFilterWhere(['objects.id' => $list]);
            }
            else {
                $filter = Filters::findOne($this->filterName);
                if ($filter) {
                    $array = unserialize($filter->ids);
                    $query->andFilterWhere(['objects.id' => $array]);
                }
            }
        }
        $query->orderBy(['objects.user_id'=>SORT_DESC,'objects.name'=>SORT_ASC]);

//        $query->notFullOccupied($this->start,$this->until,$this->userIds);

        return $dataProvider;
    }
}
