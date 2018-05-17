<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ObjectsFacilities;

/**
 * ObjectsFacilitiesSearch represents the model behind the search form of `backend\models\ObjectsFacilities`.
 */
class ObjectsFacilitiesSearch extends ObjectsFacilities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'object_id'], 'integer'],
            [['seaview', 'babycot', 'breakfast', 'halfboard', 'fullboard', 'berth', 'jacuzzi', 'terrace', 'tv_satelite', 'wifi', 'internet_fast', 'internet', 'smoking', 'luxurious', 'air_conditioning', 'tv_lcd', 'wheelchair_accessible', 'near_beach', 'pets', 'near_country', 'near_city', 'in_city', 'in_country', 'swimming_pool', 'swimming_pool_indoor', 'swimming_pool_indoor_heated', 'swimming_pool_outdoor', 'swimming_pool_outdoor_heated', 'parking', 'sauna', 'gym', 'separate_kitchen', 'elevator', 'heating', 'towels', 'linen', 'for_couples', 'for_family', 'for_friends', 'for_large_groups', 'for_wedings', 'total_privacy', 'created', 'changed'], 'safe'],
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
    public function search($params)
    {
        $query = ObjectsFacilities::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'object_id' => $this->object_id,
            'created' => $this->created,
            'changed' => $this->changed,
        ]);

        $query->andFilterWhere(['like', 'seaview', $this->seaview])
            ->andFilterWhere(['like', 'babycot', $this->babycot])
            ->andFilterWhere(['like', 'breakfast', $this->breakfast])
            ->andFilterWhere(['like', 'halfboard', $this->halfboard])
            ->andFilterWhere(['like', 'fullboard', $this->fullboard])
            ->andFilterWhere(['like', 'berth', $this->berth])
            ->andFilterWhere(['like', 'jacuzzi', $this->jacuzzi])
            ->andFilterWhere(['like', 'terrace', $this->terrace])
            ->andFilterWhere(['like', 'tv_satelite', $this->tv_satelite])
            ->andFilterWhere(['like', 'wifi', $this->wifi])
            ->andFilterWhere(['like', 'internet_fast', $this->internet_fast])
            ->andFilterWhere(['like', 'internet', $this->internet])
            ->andFilterWhere(['like', 'smoking', $this->smoking])
            ->andFilterWhere(['like', 'luxurious', $this->luxurious])
            ->andFilterWhere(['like', 'air_conditioning', $this->air_conditioning])
            ->andFilterWhere(['like', 'tv_lcd', $this->tv_lcd])
            ->andFilterWhere(['like', 'wheelchair_accessible', $this->wheelchair_accessible])
            ->andFilterWhere(['like', 'near_beach', $this->near_beach])
            ->andFilterWhere(['like', 'pets', $this->pets])
            ->andFilterWhere(['like', 'near_country', $this->near_country])
            ->andFilterWhere(['like', 'near_city', $this->near_city])
            ->andFilterWhere(['like', 'in_city', $this->in_city])
            ->andFilterWhere(['like', 'in_country', $this->in_country])
            ->andFilterWhere(['like', 'swimming_pool', $this->swimming_pool])
            ->andFilterWhere(['like', 'swimming_pool_indoor', $this->swimming_pool_indoor])
            ->andFilterWhere(['like', 'swimming_pool_indoor_heated', $this->swimming_pool_indoor_heated])
            ->andFilterWhere(['like', 'swimming_pool_outdoor', $this->swimming_pool_outdoor])
            ->andFilterWhere(['like', 'swimming_pool_outdoor_heated', $this->swimming_pool_outdoor_heated])
            ->andFilterWhere(['like', 'parking', $this->parking])
            ->andFilterWhere(['like', 'sauna', $this->sauna])
            ->andFilterWhere(['like', 'gym', $this->gym])
            ->andFilterWhere(['like', 'separate_kitchen', $this->separate_kitchen])
            ->andFilterWhere(['like', 'elevator', $this->elevator])
            ->andFilterWhere(['like', 'heating', $this->heating])
            ->andFilterWhere(['like', 'towels', $this->towels])
            ->andFilterWhere(['like', 'linen', $this->linen])
            ->andFilterWhere(['like', 'for_couples', $this->for_couples])
            ->andFilterWhere(['like', 'for_family', $this->for_family])
            ->andFilterWhere(['like', 'for_friends', $this->for_friends])
            ->andFilterWhere(['like', 'for_large_groups', $this->for_large_groups])
            ->andFilterWhere(['like', 'for_wedings', $this->for_wedings])
            ->andFilterWhere(['like', 'total_privacy', $this->total_privacy]);

        return $dataProvider;
    }
}
