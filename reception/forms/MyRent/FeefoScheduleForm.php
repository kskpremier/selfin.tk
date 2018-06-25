<?php
namespace reception\forms\MyRent;

use yii\base\Model;

class FeefoScheduleForm extends Model{
    public  $id;
    public  $object_id;
    public  $from;
    public  $to;
    public  $created;
    public  $updated;

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
            [['object_id', 'from', 'to', 'created', 'updated'], 'integer'],
        ];
    }


}