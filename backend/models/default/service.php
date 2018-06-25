<?php
/**
 * This is the template for generating the repository for model class of a specified table.
 */

use backend\models\GeneratorHelper;

/* @var $className string class name */

echo "<?php\n";
?>

<?php
$params = "";
foreach ($properties as $property => $data):
    $params.="\$form->{$property}"  .', ';
    endforeach;
$params = mb_substr($params, 0, -2);
?>

namespace reception\useCases\manage\MyRent;

use reception\entities\MyRent\<?=$className. ";\n"?>
use reception\forms\MyRent\<?=$className?>Form;<?="\n"?>
use reception\repositories\MyRent\ <?=$className.'Repository'?>;<?="\n"?>

class  <?=$className?>ManageService
{
    private <?="\$".GeneratorHelper::to_camel_case($className)."Repository"?>;

    public function __construct(<?=$className?>Repository <?="\$".GeneratorHelper::to_camel_case($className)."Repository"?>)
    {
        $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?> = <?="\$".GeneratorHelper::to_camel_case($className)."Repository"?>;
    }

    public function create($id, <?=$className?>Form $form): void
    {
    $<?=GeneratorHelper::to_camel_case($className)?> = $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?>->get($id);

    $<?=GeneratorHelper::to_camel_case($className)?>->create(<?=$params?>);

    $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?>->save($<?=GeneratorHelper::to_camel_case($className)?>);
    }


    public function edit($id, <?=$className?>Form $form): void
    {
        $<?=GeneratorHelper::to_camel_case($className)?> = $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?>->get($id);

        $<?=GeneratorHelper::to_camel_case($className)?>->edit(<?=$params?>);

        $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?>->save($<?=GeneratorHelper::to_camel_case($className)?>);
    }

    public function remove($id): void
    {
        $<?=GeneratorHelper::to_camel_case($className)?> = $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?>->get($id);
        $this-><?=GeneratorHelper::to_camel_case($className)."Repository"?>->remove($<?=GeneratorHelper::to_camel_case($className)?>);
    }
}
