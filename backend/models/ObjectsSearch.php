<?php

namespace backend\models;

use backend\helpers\RentsHelper;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Objects;

/**
 * ObjectsSearch represents the model behind the search form of `backend\models\Objects`.
 */
class ObjectsSearch extends Objects
{
    public $userIds;

    public $searchString;

    public $reception;

    public $start;
    public $until;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'unit_id'], 'integer'],
            [['userIds','start','until','searchString','reception'],'safe']
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

        $query = Objects::find();

//        $objectQuery = ObjectsQuery::new();
        
//        $subquery = Rents::find()->select('rents.id')->where(['>=', 'rents.from_date', $this->start])
//                                ->andWhere(['<=', 'rents.until_date', $this->until])
//                                ->andWhere(['active'=>'Y']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere(['objects.user_id' => $this->userIds]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $subquery = Objects::find()->select('objects.id')->where(['user_id'=>$this->userIds])->andWhere(['user_id'=>$this->user_id])->all();
//        $subquery->joinWith('rents')

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,]);

        $query->joinWith('rents');//->andWhere(['rents.active'=>'Y']);
        $query->joinWith('unit');

//            ->andFilterWhere([
//                'or',
//
//       ['and', ['>=', 'rents.from_date', $this->start], ['<=', 'rents.from_date', $this->until] ],
//       ['and', ['>', 'rents.until_date', $this->start], ['<=', 'rents.until_date', $this->until] ],
//       ['and', ['<', 'rents.from_date', $this->start], ['<', 'rents.until_date', $this->until], ['>', 'rents.until_date', $this->start] ],
//       ['and', ['>', 'rents.until_date', $this->until], ['<', 'rents.from_date', $this->until],['>', 'rents.from_date', $this->start] ]
//            ]);
//        $query->andFilterWhere(['not in','rents.id',$subquery])
//            $query->andFilterWhere(['like', 'unit.name', $this->name]);

        if ($this->reception){
            $query->andFilterWhere(['=', 'objects.user_id', $this->reception]);
        }

        return $dataProvider;
    }
}
