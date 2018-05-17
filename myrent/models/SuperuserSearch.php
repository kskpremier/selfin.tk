<?php

namespace myrent\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\Booking\Booking;

/**
 * BookingSearch represents the model behind the search form about `myrent\models\Booking`.
 */
class SuperuserrSearch extends Booking
{
    public $apartmentName;
    public $guestName;
    public $author;
    public $user;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object', 'contact_name','apartment_id', 'number_of_tourist', 'guest_id','status','source','price' ], 'integer'],
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
        $dataProvider->setSort([
            'attributes' => [
                'id'=> [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                    'label' => 'Booking #',
                    'default' => ['id' => SORT_DESC]
                ],
                'external_id'=> [
                    'asc' => ['external_id' => SORT_ASC],
                    'desc' => ['external_id' => SORT_DESC],
                    'label' => 'MyRent #',
                    'default' => ['external_id' => SORT_DESC]
                ]
            ]
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
            'booking.external_id' => $this->external_id,
            'number_of_tourist' => $this->number_of_tourist,
        ]);
        $query->andFilterWhere(['like', 'apartment.name', $this->apartmentName]);
        //$query->andFilterWhere(['like', 'guest.name', $this->guestName]);
        $query->andFilterWhere(['like', 'guest.name', $this->author]);

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['>=', 'booking.start_date', date("Y-m-d H:i:s",$this->start_date ? strtotime($this->start_date . ' 00:00:00'):null)])
        ->andFilterWhere(['<=', 'booking.end_date', date("Y-m-d H:i:s",$this->end_date ? strtotime($this->end_date . ' 23:59:59'):null)]);

        return $dataProvider;
    }
}
