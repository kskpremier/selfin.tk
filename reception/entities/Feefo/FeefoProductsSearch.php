<?php

namespace reception\entities\Feefo;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use reception\entities\Feefo\FeefoProducts;

/**
 * FeefoProductsSearch represents the model behind the search form of `reception\entities\Feefo\FeefoProducts`.
 */
class FeefoProductsSearch extends FeefoProducts
{
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'created', 'updated'], 'integer'],
            [[ 'params','title'], 'safe'],
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
        $query = FeefoProducts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['feefo_products'] = [
            'desc'=>['feefo_products.created'=>SORT_DESC],
            'asc'=>['feefo_products.created'=>SORT_ASC],
            'default'=>['feefo_products.created'=>SORT_DESC],
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
            'object_id' => $this->object_id,
            'created' => $this->created,
        ]);

        if ($this->title)
        $query->andFilterWhere(['like', 'params', $this->title]);
        $query->andFilterWhere(['like', 'params', $this->params]);
        $query->orderBy(['feefo_products.created'=>SORT_DESC, 'feefo_products.object_id'=>SORT_DESC]);

        return $dataProvider;
    }
}
