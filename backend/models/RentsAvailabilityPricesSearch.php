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
class RentsAvailabilityPricesSearch extends Objects
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['searchString','name'],'string'],
            [['occupancy'],'integer'],
            [['userIds','start','until','reception','property','filterName'],'safe']
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
        $query = Rents::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params,'ObjectsAvailabilitySearch');
         if (!$this->validate()){
             return  $dataProvider;
         }
        $query->select('rents.id, rents.active, rents.object_id, objects.user_id, (TO_DAYS(rents.from_date) - TO_DAYS("'.$this->start.'")) as "from",
(TO_DAYS(rents.until_date) - TO_DAYS("'.$this->start.'")) as "to", (TO_DAYS(rents.until_date) - TO_DAYS(rents.from_date))  as "duration"');
        $query->joinWith('object');
//        $query->joinWith('rentsStatus');
//        $query->joinWith('currency');
//        $query->joinWith('country');
//        $query->joinWith('objects.unit');

        $query->andFilterWhere(['like','rents.object_id',$this->name]);
         if ($this->property!=''&& $this->property!=null)
                $query->andFilterWhere(['rents.object_id'=>$this->property]);
        if ($this->reception!=''&& $this->reception!=null)
        $query->forReception($this->reception);
        if ($this->filterName ) {
            if (is_array($this->filterName)) {
                $list = [];
                foreach ($this->filterName as $key => $value) {
                    $filter = Filters::findOne($value);
                    $array = unserialize($filter->ids);
                    $list = array_merge($list, array_values($array));
                }
            $query->andFilterWhere(['rents.object_id' => $list]);
            }
            else {
                $filter = Filters::findOne($this->filterName);
                if ($filter) {
                    $array = unserialize($filter->ids);
                    $query->andFilterWhere(['rents.object_id' => $array]);
                }
            }
        }
        $query->inInterval($this->start, $this->until); ///only active
        $query->orderBy(['rents.object_id'=>SORT_ASC,'rents.from_date'=>SORT_ASC]);


//        $query->notFullOccupied($this->start,$this->until,$this->userIds);

        return $dataProvider;
    }
}
