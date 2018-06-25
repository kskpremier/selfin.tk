<?php

namespace reception\forms\MyRent;

use yii\base\Model;


/**
 * @property ValueForm[] $values
 */
class SearchForm extends Model
{
    public $location;
    public $from;
    public $to;
    public $numberOfGuests;
    public $numberOfRooms;
    public $space;


    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['location'], 'string'],
            [['from','to'],'string'],
            [['numberOfGuests', 'numberOfRooms','space'], 'integer'],
        ];
    }

    public function formName(): string
    {
        return '';
    }

}