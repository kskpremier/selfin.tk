<?php
/**
 * This is the template for generating the repository for model class of a specified table.
 */

use backend\models\GeneratorHelper;

/* @var $className string class name */

echo "<?php\n";
?>

namespace reception\repositories\MyRent;

use reception\entities\MyRent\<?= $className?>;
use reception\repositories\NotFoundException;

class <?= $className.'Repository' ?> 
{
    public function get($id): <?= $className?>
    {
         if (!<?= " \$".GeneratorHelper::to_camel_case($className)?> = <?= $className?>::findOne($id)) {
            throw new NotFoundException('<?= $className?> is not found.');
        }
    return <?= " \$".GeneratorHelper::to_camel_case($className)?>;
    }
    
    public function save(<?= $className?> <?= " \$".GeneratorHelper::to_camel_case($className)?>): void
    {
        if (!<?= " \$".GeneratorHelper::to_camel_case($className)?>->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(<?= $className?> <?= " \$".GeneratorHelper::to_camel_case($className)?>): void
    {
        if (!<?= " \$".GeneratorHelper::to_camel_case($className)?>->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

