<?php

namespace reception\entities\MyRent\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\MyRent\Objects;

/**
 * ObjectsSearch represents the model behind the search form of `reception\entities\MyRentReception\Objects`.
 */
class ObjectsSearch extends Objects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'unit_id', 'object_type_id', 'worker_id', 'cleaner_id', 'laundry_id', 'profile_id', 'item_id', 'currency_id', 'vat', 'vat_advance', 'balance_payment', 'sort', 'sort_front_page'], 'integer'],
            [['type', 'erp_id', 'object_type_extra', 'guid', 'price_calculation', 'calculation_type', 'object', 'name', 'color', 'picture', 'web_page', 'online_folder', 'note', 'note_long', 'description', 'web', 'instant', 'active', 'details', 'pay_casche', 'pay_iban', 'pay_paypal', 'pay_card', 'city_tax', 'guest_portal_details', 'own', 'front_page', 'price_with_vat', 'price_with_city_tax', 'door_id', 'created', 'changed'], 'safe'],
            [['price', 'exchange', 'advance_percent', 'review', 'owner_provision'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Objects::find();

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
            'unit_id' => $this->unit_id,
            'object_type_id' => $this->object_type_id,
            'worker_id' => $this->worker_id,
            'cleaner_id' => $this->cleaner_id,
            'laundry_id' => $this->laundry_id,
            'profile_id' => $this->profile_id,
            'item_id' => $this->item_id,
            'price' => $this->price,
            'exchange' => $this->exchange,
            'currency_id' => $this->currency_id,
            'vat' => $this->vat,
            'vat_advance' => $this->vat_advance,
            'balance_payment' => $this->balance_payment,
            'sort' => $this->sort,
            'sort_front_page' => $this->sort_front_page,
            'advance_percent' => $this->advance_percent,
            'review' => $this->review,
            'owner_provision' => $this->owner_provision,
            'created' => $this->created,
            'changed' => $this->changed,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'erp_id', $this->erp_id])
            ->andFilterWhere(['like', 'object_type_extra', $this->object_type_extra])
            ->andFilterWhere(['like', 'guid', $this->guid])
            ->andFilterWhere(['like', 'price_calculation', $this->price_calculation])
            ->andFilterWhere(['like', 'calculation_type', $this->calculation_type])
            ->andFilterWhere(['like', 'object', $this->object])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'web_page', $this->web_page])
            ->andFilterWhere(['like', 'online_folder', $this->online_folder])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'note_long', $this->note_long])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'instant', $this->instant])
            ->andFilterWhere(['like', 'active', $this->active])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'pay_casche', $this->pay_casche])
            ->andFilterWhere(['like', 'pay_iban', $this->pay_iban])
            ->andFilterWhere(['like', 'pay_paypal', $this->pay_paypal])
            ->andFilterWhere(['like', 'pay_card', $this->pay_card])
            ->andFilterWhere(['like', 'city_tax', $this->city_tax])
            ->andFilterWhere(['like', 'guest_portal_details', $this->guest_portal_details])
            ->andFilterWhere(['like', 'own', $this->own])
            ->andFilterWhere(['like', 'front_page', $this->front_page])
            ->andFilterWhere(['like', 'price_with_vat', $this->price_with_vat])
            ->andFilterWhere(['like', 'price_with_city_tax', $this->price_with_city_tax])
            ->andFilterWhere(['like', 'door_id', $this->door_id]);

        return $dataProvider;
    }
}
