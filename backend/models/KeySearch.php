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
    public $userId;
    public $doorLockName;
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['id', 'booking_id','door_lock_id','userId'], 'integer'],
            [['type'],'string','max' => 15],
            [['start_date', 'end_date','doorLockName','username'], 'safe'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('user');
        $query->joinWith('doorLock');
        $query->joinWith('booking');
        $query->andFilterWhere(['like', 'booking.id', $this->booking_id])
              ->andFilterWhere(['like', 'door_lock.lock_name', $this->doorLockName])
              ->andFilterWhere(['like', 'users.id', $this->userId])
              ->andFilterWhere(['like', 'users.username', $this->username]);
        $query->andFilterWhere(['>=', 'key.start_date', $this->start_date ? strtotime($this->start_date . ' 00:00:00'):null])
               ->andFilterWhere(['<=', 'key.end_date', $this->end_date ? strtotime($this->end_date . ' 23:59:59'):null]);
        return $dataProvider;
    }
}
