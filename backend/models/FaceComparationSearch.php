<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\Booking\FaceComparation;

/**
 * FaceComparationSearch represents the model behind the search form about `backend\models\FaceComparation`.
 */
class FaceComparationSearch extends FaceComparation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['origin_id'], 'integer'],
            [['face_id', 'created_at'], 'safe'],
            [['probability'], 'number'],
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
        $query = FaceComparation::find();

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
            'origin_id' => $this->origin_id,
            'probability' => $this->probability,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'face_id', $this->face_id]);

        return $dataProvider;
    }
}
