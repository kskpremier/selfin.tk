<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 8/16/17
 * Time: 9:21 AM
 */
namespace reception\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class SelfyForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;


    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image','extensions' => 'jpeg, jpg, png'], 'message'=>'file content is not correct'],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }
}