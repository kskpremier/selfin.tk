<?php
/**
 * Created by PhpStorm.
 * User: SVRybin
 * Date: 15.4.2017.
 * Time: 0:22
 */

namespace api\models;

use yii\data\ActiveDataProvider;
use backend\models\PhotoImage;

class PhotoImageSearch extends PhotoImage
{
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PhotoImage::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        // не понял назначения - закоментировал
        //$query->andFilterWhere(['like', 'title', $this->title]);
        return $dataProvider;
    }

}