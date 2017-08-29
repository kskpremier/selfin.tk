<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PhotoRealFace;

/**
 * PhotoRealFaceSearch represents the model behind the search form about `backend\models\PhotoRealFace`.
 */
class PhotoRealFaceSearch extends PhotoRealFace
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'photo_image_id', 'album_id'], 'integer'],
            [['date', 'file_name'], 'safe'],
            [['x1', 'y2', 'x2'], 'number'],
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
        $query = PhotoRealFace::find();

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
            'date' => $this->date,
            'photo_image_id' => $this->photo_image_id,
            'album_id' => $this->album_id,
            'x1' => $this->x1,
            'y2' => $this->y2,
            'x2' => $this->x2,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
