<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\DoorLock\Key;

/**
 * KeySearch represents the model behind the search form about `backend\models\Key`.
 */
class KeyOpeningSearch extends Key
{
    public $userId;
    public $admin;

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['userId'], 'integer'],
            [['admin'],'safe']
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
//        $subquery = Key::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params,'');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('user');
        $query->joinWith('doorLock.apartments');
        //forToday it should be working if it is period or permanent
//        $query->andFilterWhere(['or',
//            ['and','key.type=2', 'key.end_date>=0', ['<=', 'key.start_date',time()] ],
//            ['and', 'key.type=0',['<=', 'key.start_date',time()],['>=', 'key.end_date',time()] ]
//        ]);
//        //key belongs to this User
//        $query->andFilterWhere(['=', 'key.user_id', $this->userId]);

        //keys for admin staff
        if ($this->admin){
            $query->forUser($this->userId);
            $query->andFilterWhere(['or',
                ['and','key.type=99', ['key.end_date'=>0], ['=', 'key.start_date',0] ],
                ['and','key.type=2', 'key.end_date>=0', ['<=', 'key.start_date',time()] ],
                ['and', 'key.type=0',['<=', 'key.start_date',time()],['>=', 'key.end_date',time()] ]
            ])->orderBy(['key.type'=>SORT_DESC]);

        }
        else { //key belongs to this User
            $query->andFilterWhere(['=', 'key.user_id', $this->userId]);
            $query->andFilterWhere(['or',
                ['and','key.type=2', 'key.end_date>=0', ['<=', 'key.start_date',time()] ],
                ['and', 'key.type=0',['<=', 'key.start_date',time()],['>=', 'key.end_date',time()] ]
            ]);
        }
       // $query->andWhere(['key.type'=>99]);

        return $dataProvider;
    }
}
