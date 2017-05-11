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
use backend\models\KeyboardPwd;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeyboardPwdSearch extends KeyboardPwd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return[
        [['keyboard_pwd_version', 'booking_id','value','door_lock_id'], 'integer'],
            [['keyboard_pwd_type'],'string','max' => 15],
            [['start_day', 'start_day'], 'string', 'max' => 20],

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
            'value' => $this->value,
            'booking_id' => $this->booking_id,
            'door_lock_id' => $this->door_lock_id,
        ]);

        $query->andFilterWhere(['like', 'start_day', $this->start_day])
            ->andFilterWhere(['like', 'end_day', $this->end_day])
            ->andFilterWhere(['like', 'keyboard_pwd_type', $this->keyboard_pwd_type])
            ->andFilterWhere(['like', 'keyboard_pwd_version', $this->keyboard_pwd_version])
            ->andFilterWhere(['like', 'keyboard_pwd_version', $this->keyboard_pwd_version]);

        return $dataProvider;
    }
}