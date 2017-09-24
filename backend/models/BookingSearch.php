<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Booking;

/**
 * BookingSearch represents the model behind the search form about `backend\models\Booking`.
 */
class BookingSearch extends Booking
{
    public $apartmentName;
    public $guestName;
    public $author;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'apartment_id', 'number_of_tourist', 'guest_id'], 'integer'],
            [['start_date', 'end_date','apartmentName','guestName','author'], 'safe'],
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
        $query = Booking::find();

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
        $query->joinWith('apartment');
        //$query->joinWith('guests');
        $query->joinWith('author');
        $query->joinWith('keys');
        $query->joinWith('keyboardPwds');

        // grid filtering conditions
        $query->andFilterWhere([
            'booking.id' => $this->id,
            'number_of_tourist' => $this->number_of_tourist,
        ]);
        $query->andFilterWhere(['like', 'apartment.name', $this->apartmentName]);
        //$query->andFilterWhere(['like', 'guest.name', $this->guestName]);
        $query->andFilterWhere(['like', 'guest.name', $this->author]);



        $query->andFilterWhere(['>=', 'booking.start_date', date("Y-m-d H:i:s",$this->start_date ? strtotime($this->start_date . ' 00:00:00'):null)])
        ->andFilterWhere(['<=', 'booking.end_date', date("Y-m-d H:i:s",$this->end_date ? strtotime($this->end_date . ' 23:59:59'):null)]);

        return $dataProvider;
    }
}
