<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Key;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeySearch extends \backend\models\Key
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pin', 'booking_id','door_lock_id'], 'integer'],
            [['type'],'string','max' => 15],
            [['start_date', 'end_date', 'e_key'], 'safe'],
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
            'door_lock_id' => $this->door_lock_id,
        ]);

        $query ->andFilterWhere(['like', 'e_key', $this->e_key])
               ->andFilterWhere(['like', 'type', $this->type]);
        $query->andFilterWhere(['>=', 'key.start_date', $this->start_date ? strtotime($this->start_date . ' 00:00:00'):null])
               ->andFilterWhere(['<=', 'key.end_date', $this->end_date ? strtotime($this->end_date . ' 23:59:59'):null]);

        return $dataProvider;
    }
}
