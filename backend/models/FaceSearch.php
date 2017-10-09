<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\Face;

/**
 * FaceSearch represents the model behind the search form about `backend\models\Face`.
 */
class FaceSearch extends Face
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'photo_image_id','photo_document_id'], 'integer'],
            [['face_id'], 'safe'],
            [['x', 'y', 'width', 'angle'], 'number'],
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
        $query = Face::find();

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
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'angle' => $this->angle,
            'photo_image_id' => $this->photo_image_id,
            'photo_document_id'=>$this->photo_document_id,
        ]);

        $query->andFilterWhere(['like', 'face_id', $this->face_id]);

        return $dataProvider;
    }
}
