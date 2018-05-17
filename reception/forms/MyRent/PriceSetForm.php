<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:06
 */

namespace reception\forms\MyRent;

/**
 * @property float $price
 * @property int $id
 * @property int $min_stay

 **/

use yii\base\Model;

class PriceSetForm extends Model
{
    public $id;
    public $price;
    public $min_stay;
    public $indexes;
    public $firstDay;
    public $stays;
    public $prices;


    /**
     * @inheritdoc
     */
    public function rules() : array
    {
        $rules = [
            [[ "min_stay"], 'integer'],
            [[ "price"], 'double'],
            [['firstDay'],'string'],
            [['firstDay'],'required'],
            [['indexes','id','prices','stays'],'safe'],
            [['indexes','id'],'required']
        ];
        return $rules;
    }

}