<?php

namespace backend\models;

use reception\entities\User\User;
use const SORT_ASC;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\DoorLock\Key;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeyAdminSearch extends Key
{
    public $userId;
    public $parents;
    public $doorLockName;
    public $username;
    public $owner;

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['userId','booking_id','door_lock_id','type',], 'integer'],
            [['start_date', 'end_date','doorLockName','username','owner'],'safe'],
            [['parents'],'safe']
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params,'KeyAdminSearch');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('user');
//        $query->joinWith('user.parentUsers as super');
        $query->joinWith('doorLock.apartments');
        $query->joinWith('booking');
//        $query->joinWith('booking.apartment as bookedApartment');

        //key belongs to this User or to his "parent" user or to some tourist in set of apartmetns
        $query->andFilterWhere(['=', 'key.user_id', $this->userId]);
        $query->andFilterWhere(['=',  'apartment.user_id', $this->owner]);
//        $query->andFilterWhere(['=', 'booking.apartment_id', $this->userId]);
        $query->orFilterWhere(['or',['=', 'door_lock.user_id', $this->userId],['in', 'door_lock.user_id', $this->parents]]);
        $query->orFilterWhere(['or',['=', 'apartment.user_id', $this->userId],['in', 'apartment.user_id', $this->parents],
//                                    ['=', 'bookedApartment.user_id', $this->userId],['in', 'bookedApartment.user_id', $this->parents]
        ]);

        $query->orderBy(['key.type'=>SORT_ASC,'apartment.name'=>SORT_ASC,'start_date'=>SORT_ASC]);
        $query->andFilterWhere(['=', 'key.door_lock_id', $this->door_lock_id]);
        $query->andFilterWhere([ 'key.booking_id'=>$this->booking_id,'key.type'=>$this->type]);
        $query->andFilterWhere(['like','door_lock.lock_alias',$this->doorLockName]);
        $query->andFilterWhere(['like','username',$this->username]);
        $query->andFilterWhere(['>=', 'key.start_date', $this->start_date ? strtotime($this->start_date . ' 00:00:00'):null])
            ->andFilterWhere(['<=', 'key.end_date', $this->end_date ? strtotime($this->end_date . ' 23:59:59'):null]);

        return $dataProvider;
    }
}
