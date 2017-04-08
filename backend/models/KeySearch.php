<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Key;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeySearch extends Key
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pin', 'booking_id'], 'integer'],
            [['from', 'till', 'e_key'], 'safe'],
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
        $query = Key::find();

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
            'pin' => $this->pin,
            'booking_id' => $this->booking_id,
        ]);

        $query->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'till', $this->till])
            ->andFilterWhere(['like', 'e_key', $this->e_key]);

        return $dataProvider;
    }
}
