<?php
namespace reception\forms\MyRent;

use reception\entities\Feefo\FeefoSales;
use yii\base\Model;

class FeefoSalesForm extends Model{
    public  $id;
    public  $rent_id;
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
            [['rent_id'], 'integer'],
            [['created'], 'safe'],
            [['log'], 'string'],
        ];
    }


    protected function internalForms(): array
    {
        return [
        ];
    }

}