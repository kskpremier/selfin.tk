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

<?php $params="";
foreach ($properties as $property => $data):
    $params.="\${$property}"  .', ';
endforeach;
$params = mb_substr($params, 0, -2);
?>

namespace <?= $generator->ns."\\entities\\MyRent" ?>;

use Yii;
<?php foreach ($relations as $name => $relation): ?>
<?="use reception\\entities\\MyRent\\".GeneratorHelper::to_class_name_case($name).";". "\n"?>
<?php endforeach; ?>

/**
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($properties as $property => $data): ?>
 * @property <?= "{$data['type']} \${$property}"  . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

    /**
    <?php foreach ($properties as $property => $data): ?>
    * @param <?= "{$data['type']} \${$property}"  . '//'.($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
    <?php endforeach; ?>
    * @return <?= $className ?>
    */
    public static function create(<?=$params?>): <?= $className. "\n" ?>
    {
        <?= "\$".GeneratorHelper::to_camel_case($className) ?> = new static();
        <?php foreach ($labels as $name => $label): ?>
        <?= "\$".GeneratorHelper::to_camel_case($className)."->".$name." = \$".$name.";" . "\n" ?>
        <?php endforeach; ?>

        return <?="\$".GeneratorHelper::to_camel_case($className).";" . "\n"?>
    }

    /**
    <?php foreach ($properties as $property => $data): ?>
        * @param <?= "{$data['type']} \${$property}"  . '//'.($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
    <?php endforeach; ?>
    * @return <?= $className ?>
    */
    public function edit(<?=$params?>): <?= $className . "\n"?>
    {

    <?php foreach ($labels as $name => $label): ?>
        <?= "\$this->".$name." = \$".$name.";" . "\n" ?>
    <?php endforeach; ?>

        return <?="\$this;" . "\n"?>
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
        ];
    }
<?php foreach ($relations as $name => $relation): ?>

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get<?= $name ?>()
    {
        <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
<?php if ($queryClassName): ?>
<?php
    $queryClassFullName = (($generator->ns."\\entities\\MyRent") === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
?>
    /**
     * {@inheritdoc}
     * @return <?= $queryClassFullName ?> the active query used by this AR class.
     */
    public static function find()
    {
        return new <?= $queryClassFullName ?>(get_called_class());
    }
<?php endif; ?>
}
