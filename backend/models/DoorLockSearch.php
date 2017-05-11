<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DoorLock;

/**
 * DoorLockSearch represents the model behind the search form about `backend\models\DoorLock`.
 */
class DoorLockSearch extends DoorLock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'admin_pin', 'apartment_id'], 'integer'],
            [['type','lockId'], 'safe'],
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
        $query = DoorLock::find();

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
            'admin_pin' => $this->admin_pin,
            'apartment_id' => $this->apartment_id,

        ]);

        $query->andFilterWhere(['like', 'type', $this->type]);
        $query->andFilterWhere(['like', 'lockId', $this->lockId]);

        return $dataProvider;
    }
}
