<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rents;

/**
 * RentsSearch represents the model behind the search form of `backend\models\Rents`.
 */
class RentsSearch extends Rents
{
    public $searchString;
    public $userIds;

    public $object;
    public $status;
    public $source;
    public $reception;

    public $start;
    public $until;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'rent_status_id', 'user_id', 'cleaner_id', 'customer_id', 'item_id', 'parent_rent_id', 'number', 'currency_id', 'deposit_currency_id', 'payment_method_id',
                'price_neto_currency_id', 'in_advance_currency_id', 'contact_type_id', 'contact_country_id', 'raiting', 'rent_import_id', 'rent_source_id'], 'integer'],
            [['guid', 'type', 'request_for_payment', 'from_date', 'from_time', 'from_time_confirm', 'until_date', 'until_time', 'until_time_confirm', 'note', 'note_short',
                'note_user', 'note_cancellation_policy', 'deposit_active', 'price_with_vat', 'price_with_city_tax', 'paid', 'money_recived', 'in_advance_paid', 'price_date',
                'in_advance_date', 'contact_name', 'contact_email', 'contact_tel', 'contact_adress', 'contact_city_zip', 'contact_city', 'confirm_datetime', 'contact_confirm',
                'valid_date', 'valid_time', 'rating_note', 'foreign_id', 'foreign_id_1', 'foreign_id_2', 'import_message', 'erp_id', 'door_pin', 'door_pin_active', 'owner',
                'searchable', 'active_temp', 'active', 'opend', 'confirmed_date', 'canceled_date', 'created', 'changed'], 'safe'],
            [['discount', 'price', 'price_extra', 'price_netto', 'deposit', 'rent_source_provision', 'exchange', 'in_advance', 'in_advance_exchange', 'price_neto', 'price_neto_exchange'], 'number'],
            [['searchString','reception', 'object','status', 'source','start','until'],"string"],
            [['userIds'],'safe']
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
        $query = Rents::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $query->andFilterWhere(['rents.user_id' => $this->userIds]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'rents.id' => $this->id,
            'rents.active' => $this->active,
            'objects.user_id'=>$this->reception,
        ]);
        $query->joinWith("object");
        $query->joinWith("object.unit");
        $query->joinWith("rentsSources");
        $query->joinWith("rentsStatus");


        $query->andFilterWhere(['like', 'objects.name', $this->object])
                ->andFilterWhere(['like', 'contact_name', $this->contact_name])
                ->andFilterWhere(['>=', 'rents.from_date', $this->start])
                ->andFilterWhere(['<=', 'rents.until_date', $this->until])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'rents_sources.name', $this->source])
                ->andFilterWhere([
                'or',
                    ['like', 'rents.erp_id', $this->source],
                    ['like', 'rents.contact_name', $this->searchString],
                    ['like', 'rents.contact_email', $this->searchString],
                    ['like', 'rents.erp_id', $this->searchString],
                    ['like', 'objects.name', $this->searchString],
                    ['like', 'rents_sources.name', $this->searchString],
                    ['like', 'units.city_name', $this->searchString]

                ]);

        return $dataProvider;
    }
}
