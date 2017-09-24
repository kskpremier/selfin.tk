<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 7:42
 */
namespace reception\forms\manage\Shop\Order;

use reception\entities\DoorLock\LockVersion;
use reception\forms\CompositeForm;

/**
 */
class LockVersionEditForm extends CompositeForm
{
    public $note;

    public function __construct( array $config = [])
    {

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            //[['note'], 'string'],
        ];
    }

    protected function internalForms(): array
    {
        return ['delivery', 'customer'];
    }
}