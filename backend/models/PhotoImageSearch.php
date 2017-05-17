<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PhotoImage;

/**
 * PhotoImageSearch represents the model behind the search form about `backend\models\PhotoImage`.
 */
class PhotoImageSearch extends PhotoImage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'camera_id', 'album_id','user_id','booking_id'], 'integer'],
            [['date', 'file_name'], 'safe'],
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
        $query = PhotoImage::find();

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
            'camera_id' => $this->camera_id,
            'album_id' => $this->album_id,
            'user_id' => $this->album_id,
            'booking_id' => $this->album_id,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
