<?php
namespace reception\forms\MyRent;

use reception\entities\Feefo\FeefoProducts;
use yii\base\Model;

class FeefoProductsForm extends Model{
    public  $id;
    public  $object_id;
    public  $created;
    public  $log;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['object_id', 'created'], 'integer'],
            [['log'], 'string'],
        ];
    }


    protected function internalForms(): array
    {
        return [
        ];
    }

}