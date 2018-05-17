<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ObjectsRealestates;

/**
 * ObjectsRealestatesSearch represents the model behind the search form of `backend\models\ObjectsRealestates`.
 */
class ObjectsRealestatesSearch extends ObjectsRealestates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'object_type_id', 'property_type_id', 'object_name_id', 'can_sleep_max', 'promotion_id', 'can_sleep_optimal', 'floor', 'min_stay', 'security_deposit_type', 'down_deposit_type', 'standard_guests', 'classification_star'], 'integer'],
            [['name', 'motto', 'note', 'description', 'changeover', 'wifi_network', 'wifi_password', 'check_in', 'check_out', 'smoking', 'luxurius', 'air_conditioning', 'internet', 'wheelchair_accessible', 'pets', 'swimming_pool', 'parking', 'loc_beach', 'loc_country', 'loc_city', 'tripadvisor_review', 'created', 'changed'], 'safe'],
            [['beds', 'beds_extra', 'bathrooms', 'bedrooms', 'toilets', 'baby_coat', 'high_chair', 'security_deposit', 'down_deposit', 'cleaning_price', 'space', 'space_yard', 'price_standard', 'guest_review'], 'number'],
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
        $query = ObjectsRealestates::find();

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
            'object_id' => $this->object_id,
            'object_type_id' => $this->object_type_id,
            'property_type_id' => $this->property_type_id,
            'object_name_id' => $this->object_name_id,
            'can_sleep_max' => $this->can_sleep_max,
            'promotion_id' => $this->promotion_id,
            'can_sleep_optimal' => $this->can_sleep_optimal,
            'beds' => $this->beds,
            'beds_extra' => $this->beds_extra,
            'bathrooms' => $this->bathrooms,
            'bedrooms' => $this->bedrooms,
            'toilets' => $this->toilets,
            'baby_coat' => $this->baby_coat,
            'high_chair' => $this->high_chair,
            'floor' => $this->floor,
            'min_stay' => $this->min_stay,
            'security_deposit_type' => $this->security_deposit_type,
            'security_deposit' => $this->security_deposit,
            'down_deposit_type' => $this->down_deposit_type,
            'down_deposit' => $this->down_deposit,
            'cleaning_price' => $this->cleaning_price,
            'space' => $this->space,
            'space_yard' => $this->space_yard,
            'standard_guests' => $this->standard_guests,
            'classification_star' => $this->classification_star,
            'price_standard' => $this->price_standard,
            'guest_review' => $this->guest_review,
            'created' => $this->created,
            'changed' => $this->changed,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'motto', $this->motto])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'changeover', $this->changeover])
            ->andFilterWhere(['like', 'wifi_network', $this->wifi_network])
            ->andFilterWhere(['like', 'wifi_password', $this->wifi_password])
            ->andFilterWhere(['like', 'check_in', $this->check_in])
            ->andFilterWhere(['like', 'check_out', $this->check_out])
            ->andFilterWhere(['like', 'smoking', $this->smoking])
            ->andFilterWhere(['like', 'luxurius', $this->luxurius])
            ->andFilterWhere(['like', 'air_conditioning', $this->air_conditioning])
            ->andFilterWhere(['like', 'internet', $this->internet])
            ->andFilterWhere(['like', 'wheelchair_accessible', $this->wheelchair_accessible])
            ->andFilterWhere(['like', 'pets', $this->pets])
            ->andFilterWhere(['like', 'swimming_pool', $this->swimming_pool])
            ->andFilterWhere(['like', 'parking', $this->parking])
            ->andFilterWhere(['like', 'loc_beach', $this->loc_beach])
            ->andFilterWhere(['like', 'loc_country', $this->loc_country])
            ->andFilterWhere(['like', 'loc_city', $this->loc_city])
            ->andFilterWhere(['like', 'tripadvisor_review', $this->tripadvisor_review]);

        return $dataProvider;
    }
}
