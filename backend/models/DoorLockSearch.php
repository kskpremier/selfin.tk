<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;


/**
 * DoorLockSearch represents the model behind the search form about `backend\models\DoorLock`.
 */
class DoorLockSearch extends \reception\entities\DoorLock\DoorLock
{
    public $apartmentName;
    public $user;
    public $booking;
    public $doorlock;
    public $key;
    public $password;
    public $owner;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'admin_pwd', 'apartment_id','lock_id', 'doorlock','booking'], 'integer'],
            [['type','lock_id','lock_mac','lock_name','lock_alias','apartmentName', 'key', 'password', 'user', 'owner'], 'safe'],
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
        $query = \reception\entities\DoorLock\DoorLock::find();

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

        $query->joinWith('apartments');
        // grid filtering conditions
        $query->andFilterWhere(['door_lock.id' => $this->id,]);
        $query->andFilterWhere(['like', 'lock_name', $this->lock_name]);
        $query->andFilterWhere(['like', 'lock_alias', $this->lock_alias]);
        $query->andFilterWhere(['like', 'apartment.name', $this->apartmentName]);
        $query->andFilterWhere(['like', 'users.name', $this->owner]);
        $query->andFilterWhere(['like', 'lock_mac', $this->lock_mac]);
        $query->forUser($this->user);


        return $dataProvider;
    }
}
