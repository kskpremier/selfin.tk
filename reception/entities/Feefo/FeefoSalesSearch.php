<?php

namespace reception\entities\Feefo;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\Feefo\FeefoSales;

/**
 * FeefoSalesSearch represents the model behind the search form of `reception\entities\Feefo\FeefoSales`.
 */
class FeefoSalesSearch extends FeefoSales
{
public $name;
public $email;
public $property;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rent_id'], 'integer'],
            [['created', 'log','params','name','email','property'], 'safe'],
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
        $query = FeefoSales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['feefo_sales'] = [
            'desc'=>['feefo_sales.created'=>SORT_DESC],
            'asc'=>['feefo_sales.created'=>SORT_ASC],
            'default'=>['feefo_sales.created'=>SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'rent_id' => $this->rent_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'log', $this->log]);
        $query->andFilterWhere(['like', 'rent_id', $this->rent_id]);
        if ($this->name)
             $query->andFilterWhere(['like', 'params', $this->name]);
        if ($this->email)
            $query->andFilterWhere(['like', 'params', $this->email]);
        if ($this->property)
            $query->forPropertyName([$this->property]);
        $query->andFilterWhere(['like', 'params', $this->params]);
        $query->orderBy(['feefo_sales.created'=>SORT_DESC, 'feefo_sales.rent_id'=>SORT_DESC]);

        return $dataProvider;
    }
}