<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\DoorLock\Key;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeySearch extends Key
{
    public $userId;
    public $doorLockName;
    public $username;
    public $bookingId;
    public $owner;
    public $tourist_user_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['id','door_lock_id','userId','bookingId','owner','user_id','tourist_user_id'], 'integer'],
            [['type'],'string','max' => 15],
            [['start_date', 'end_date','doorLockName','username','booking_id'], 'safe'],
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
//        if ($bookingId) {'booking_id',
//
//        }

        $this->load($params,'');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('user');
        $query->joinWith('doorLock');
        $query->joinWith('doorLock.apartments');
        $query->joinWith('booking');
        $query->andFilterWhere(['like', 'booking.id', $this->booking_id])
              ->andFilterWhere(['like', 'booking.id', $this->bookingId])
              ->andFilterWhere(['like', 'door_lock.lock_alias', $this->doorLockName])
              ->andFilterWhere(['like', 'key.user_id', $this->userId])
              ->andFilterWhere(['like', 'key.user_id', $this->tourist_user_id])
              ->andFilterWhere(['like', 'apartment.user_id', $this->userId])
              ->andFilterWhere(['like', 'users.username', $this->username])
              ->andFilterWhere(['=', 'apartment.user_id',$this->owner]);
        $query->andFilterWhere(['>=', 'key.start_date', $this->start_date ? strtotime($this->start_date . ' 00:00:00'):null])
               ->andFilterWhere(['<=', 'key.end_date', $this->end_date ? strtotime($this->end_date . ' 23:59:59'):null]);
        return $dataProvider;
    }
}
