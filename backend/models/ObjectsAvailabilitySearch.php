<?php

namespace backend\models;

use function is_array;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rents;
use backend\models\Objectss;
use yii\data\Pagination;

/**
 * RentsSearch represents the model behind the search form of `backend\models\Rents`.
 */
class ObjectsAvailabilitySearch extends Objects
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
    public $objectIds;
    public $detailFilter;

// private $filter1 = [6994, 6993, 6992, 6991, 6989, 6974, 6973, 6970, 6969, 6949, 6948, 6947, 6946, 6945, 6944];
//    private $filter2 = [11970, 11754, 11371, 11370, 11369, 11368, 11367, 11366, 11365, 11125, 11124, 11122, 11105, 10889, 10180, 10179, 10178, 10166, 10165, 10164, 10163, 10136];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['searchString','name'],'string'],
            [['occupancy'],'integer'],
            [['userIds','start','until','reception','property','filterName','objectIds','detailFilter'],'safe']
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
    public function search($params=null, $detailFilter=null)
    {
//        $objectsList=[];
        $query = Objects::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params,'ObjectsAvailabilitySearch');
         if (!$this->validate()){
             return  $dataProvider;
         }
//        $query->availabilityCalc($this->start,$this->until);
//        if(is_array($this->name)){
//
//            $query->andFilterWhere(['like','objects.id',$this->name]);
//
//        }
        if ($this->detailFilter){
            $query->forDetailFilter($detailFilter);
        }

        $query->andFilterWhere(['like','objects.id',$this->name]);
         if ($this->objectIds!=''&& $this->objectIds!=null) {
             $query->andFilterWhere(['in','objects.id',explode(',',$this->objectIds)]);
         }
         if ($this->property!=''&& $this->property!=null)
                $query->andFilterWhere(['objects.id'=>$this->property]);
//        $query->joinWith('rents');
//        $query->joinWith('rents.rentsStatus');
//        $query->joinWith('rents.currency');
//        $query->joinWith('rents.country');
//
////        $query->joinWith('rents.country');
        $query->joinWith('unit');
        $query->joinWith('unit.country');
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
