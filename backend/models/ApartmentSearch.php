<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Apartment;

/**
 * ApartmentSearch represents the model behind the search form about `backend\models\Apartment`.
 */
class ApartmentSearch extends Apartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'door_lock_id', 'camera_id'], 'integer'],
            [['location', 'name'], 'safe'],
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
        $query = Apartment::find();

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
            'location' => $this->location,
            'name' => $this->name,
            'door_lock_id' => $this->door_lock_id,
            'camera_id' => $this->camera_id,
        ]);

        return $dataProvider;
    }
}
