<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 5/31/18
 * Time: 11:23 AM
 */
namespace backend\models;

use Yii;
use yii\gii\generators\model\Generator;
use yii\gii\CodeFile;



class GeneratorClass extends Generator {
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $files = [];
        $relations = $this->generateRelations();
        $db = $this->getDbConnection();
        foreach ($this->getTableNames() as $tableName) {
            // model :
            $modelClassName = $this->generateClassName($tableName);
            $queryClassName = ($this->generateQuery) ? $this->generateQueryClassName($modelClassName) : false;
            $tableSchema = $db->getTableSchema($tableName);
            $params = [
                'tableName' => $tableName,
                'className' => $modelClassName,
                'queryClassName' => $queryClassName,
                'tableSchema' => $tableSchema,
                'properties' => $this->generateProperties($tableSchema),
                'labels' => $this->generateLabels($tableSchema),
                'rules' => $this->generateRules($tableSchema),
                'relations' => isset($relations[$tableName]) ? $relations[$tableName] : [],
            ];
            $files[] = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns."\\entities\\MyRent")) . '/' . $modelClassName . '.php',
                $this->render('model.php', $params)
            );
            $files[] = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns."\\forms\\MyRent")) . '/' . $modelClassName . 'Form.php',
                $this->render('form.php', $params)
            );
            $files[] = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns."\\repositories\\MyRent")) . '/' . $modelClassName . 'Repository.php',
                $this->render('repository.php', $params)
            );
            $files[] = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns."\\useCases\\MyRent")) . '/' . $modelClassName . 'ManageService.php',
                $this->render('service.php', $params)
            );

            // query :
            if ($queryClassName) {
                $params['className'] = $queryClassName;
                $params['modelClassName'] = $modelClassName;
                $files[] = new CodeFile(
                    Yii::getAlias('@' . str_replace('\\', '/', $this->queryNs)) . '/' . $queryClassName . '.php',
                    $this->render('query.php', $params)
                );
            }
        }

        return $files;
    }
}