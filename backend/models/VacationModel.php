<?php
namespace backend\models;

use reception\services\MyRent\MyRent;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 3/6/18
 * Time: 12:10 AM
 */

class VacationModel extends Model {

    public $id;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id'], 'safe'],
        ];
    }

    public function getModels() {
        $list = MyRent::getVacationObjects();
    }
}