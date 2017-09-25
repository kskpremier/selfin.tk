<?php

namespace reception\forms\manage;

use reception\entities\Apartment\Apartment;
use reception\entities\Apartment\Owner;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ApartmentForm extends Model
{
    public $exist = [];
    public $others = [];

    public function __construct(Owner $owner = null, $config = [])
    {
        if ($owner) {
            $this->exist = $owner->apartments;//ArrayHelper::getColumn($owner->apartments, 'id');
            $this->others =  $this->exist;
        }
        parent::__construct($config);
    }

    public function apartmentsList(): array
    {
        return ArrayHelper::map(Apartment::find()->orderBy('name')->asArray()->all(), 'id', function (array $apartment) {
            return  $apartment['name'];
        });
    }
    public function apartmentExistingList(): array
    {
//        foreach ($this->exist as $apartment) {
//            $apartments[] = $apartment->name;
//        }
//        return $apartments;
        return ArrayHelper::getColumn($this->exist, 'name');
    }

    public function rules(): array
    {
        return [
            ['others', 'each', 'rule' => ['integer']],
            ['others', 'default', 'value' => []],
        ];
    }
}