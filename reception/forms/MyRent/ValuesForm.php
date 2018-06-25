<?php

namespace reception\forms\MyRent;

use yii\base\Model;

/**
 * @property integer $id
 */
class ValuesForm extends Model
{
    public $from;
    public $to;
    public $equal;

    private $_attribute;

    public function __construct($attribute, $config = [])
    {
        $this->_attribute = $attribute;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([
            $this->_attribute ? ['safe'] : false,
        ]);
    }

    public function formName(): string
    {
        return 'v';
    }
}