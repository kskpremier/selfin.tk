<?php

namespace backend\models;

use const SORT_DESC;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ObjectsPricesDays;

/**
 * ObjectsPricesDaysSearch represents the model behind the search form of `backend\models\ObjectsPricesDays`.
 */
class ObjectsPricesDaysSearch extends ObjectsPricesDays
{
    public $from;
    public $until;
    public $objectIds;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from','until','objectIds'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params=null)
    {
        $query = ObjectsPricesDays::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->select('objects_prices_days.price, objects_prices_days.day, objects.name, objects_prices_days.object_id, objects_prices_days.min_stay as min, (TO_DAYS(day) - TO_DAYS("'.$this->from.'")) as "index"');
        // grid filtering conditions
//        $query->andFilterWhere([
////            'id' => $this->id,
////            'user_id' => $this->user_id,
////            'object_id' => $this->object_id,
////            'item_id' => $this->item_id,
////            'group_id' => $this->group_id,
////            'stock' => $this->stock,
////            'day' => $this->day,
////            'price' => $this->price,
////            'price_b2b' => $this->price_b2b,
////            'price_special' => $this->price_special,
////            'min_stay' => $this->min_stay,
////            'days_before' => $this->days_before,
////            'price_extra' => $this->price_extra,
////            'price_extra_child' => $this->price_extra_child,
////            'extra_from' => $this->extra_from,
////            'created' => $this->created,
////            'changed' => $this->changed,
//        ]);
        $query->joinWith('object');
//
//        $query->andFilterWhere(['like', 'check_in', $this->check_in])
//            ->andFilterWhere(['like', 'check_out', $this->check_out])
//            ->andFilterWhere(['like', 'enable', $this->enable]);

        $query->andFilterWhere(['>=','day',$this->from]);
        $query->andFilterWhere(['<=','day',$this->until]);
        $query->andFilterWhere(['object_id'=>$this->objectIds]);
//        $query->indexBy('object_id');
//        $query->select('price, day, min_stay, object_id');
        $query->orderBy(['object_id'=>SORT_ASC,'day'=>SORT_ASC]);

        return $dataProvider;
    }
}
