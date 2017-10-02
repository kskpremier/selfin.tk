<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\Booking\Photo;

/**
 * PhotoImageSearch represents the model behind the search form about `backend\models\PhotoImage`.
 */
class PhotoImageSearch extends Photo
{
    public $date_from;
    public $date_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'album_id','user_id','booking_id'], 'integer'],
            [['date', 'file_name'], 'safe'],
            [['date_from','date_to'],'date']
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
        $query = Photo::find();

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

            'album_id' => $this->album_id,
            //'user_id' => $this->user_id,
            'booking_id' => $this->booking_id,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
        ->andFilterWhere(['>=', 'photo_image.date', $this->date_from ? strtotime($this->date_from . '00:00:00'):null])
        ->andFilterWhere(['<=', 'photo_image.date', $this->date_to ? strtotime($this->date_to . '23:59:59'):null]);

        return $dataProvider;
    }
}
