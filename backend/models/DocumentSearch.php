<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Document;

/**
 * DocumentSearch represents the model behind the search form about `backend\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'photo_document_face_id', 'document_type_id', 'country_id', 'photo_document_id', 'guest_id'], 'integer'],
            [['first_name', 'second_name', 'number', 'seria', 'date_of_issue', 'valid_before'], 'safe'],
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
        $query = Document::find();

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
            'photo_document_face_id' => $this->photo_document_face_id,
            'document_type_id' => $this->document_type_id,
            'country_id' => $this->country_id,
            'valid_before' => $this->valid_before,
            'photo_document_id' => $this->photo_document_id,
            'guest_id' => $this->guest_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'seria', $this->seria])
            ->andFilterWhere(['like', 'date_of_issue', $this->date_of_issue]);

        return $dataProvider;
    }
}
