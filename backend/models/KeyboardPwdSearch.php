<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 13:08
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\DoorLock\KeyboardPwd;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeyboardPwdSearch extends KeyboardPwd
{
    public $doorLockName;
    public $user;
    public $owner;
    public $tourist;
    public $lockUser;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return[
            [['keyboard_pwd_version','value','door_lock_id',], 'integer'],
            [['keyboard_pwd_type'],'string','max' => 15],
            [['start_date', 'end_date','doorLockName','booking_id','user','tourist','lockUser','owner'], 'safe'],

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
        $query = KeyboardPwd::find();

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
        $query->joinWith(['doorLock']);
        $query->joinWith(['booking']);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'booking_id' => $this->booking_id,
            'door_lock_id' => $this->door_lock_id,
        ]);

        if ($this->user) {
            $query->forUser($this->user);
        }
        if ($this->lockUser) {
            $query->forLockUser($this->lockUser);
        }
        if ($this->tourist) {
            $query->isValidForTourist($this->tourist);
            $query->isValidForUser($this->tourist);
        }
        if ($this->owner) {
            $query->forOwner($this->owner);
        }

        $query->andFilterWhere(['like', 'value', $this->value]);
        $query->andFilterWhere(['like', 'door_lock.lock_alias', $this->doorLockName]);
        $query->andFilterWhere(['like', 'keyboard_pwd_type', $this->keyboard_pwd_type])
              ->andFilterWhere(['like', 'keyboard_pwd_version', $this->keyboard_pwd_version]);
        $query->andFilterWhere(['>=', 'keyboard_pwd.start_date', $this->start_date ? strtotime($this->start_date . ' 00:00:00'):null])
              ->andFilterWhere(['<=', 'keyboard_pwd.end_date', $this->end_date ? strtotime($this->end_date . ' 23:59:59'):null]);

        return $dataProvider;
    }
}