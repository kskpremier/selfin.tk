<?php
/**
 * This is the template for generating the model class of a specified table.
 */

use backend\models\GeneratorHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $properties array list of properties (property => [type, name. comment]) */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>
namespace reception\forms\MyRent;

use reception\entities\MyRent\<?=($className)?>;
<?php echo (count($relations)>0)? "use reception\\forms\\CompositeForm;". "\n":"use yii\\base\\Model;". "\n";?>
<?php foreach ($relations as $name => $relation): ?>
<?="use reception\\forms\\".GeneratorHelper::to_class_name_case($name)."Form;". "\n"?>
<?php endforeach; ?>

class <?= GeneratorHelper::to_class_name_case($className)?>Form extends <?php echo (count($relations)>0)? "CompositeForm":"Model";?>
{
    <?php foreach ($properties as $property => $data): ?>
       public <?= " \${$property}".";". "\n" ?>
    <?php endforeach; ?>

    public function __construct(array $config = [])
    {
        <?php foreach ($relations as $name => $relation): ?>
            <?="\$this->".GeneratorHelper::to_camel_case($name)?> = new  <?= GeneratorHelper::to_class_name_case($name)."Form();". "\n"?>
        <?php endforeach; ?>
            parent::__construct($config);
    }

    /**
    * {@inheritdoc}
    */
    public function rules(): array
    {
        return [<?= empty($rules) ? '' : ("\n            " . implode(",\n            ", $rules) . ",\n        ") ?>];
    }


    protected function internalForms(): array
    {
        return [
        <?php foreach ($relations as $name => $relation): ?>
            <?="'".GeneratorHelper::to_camel_case($name)."',"."\n" ?>
        <?php endforeach; ?>
        ];
    }

}
