<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 04.07.17
 * Time: 22:30
 */

namespace reception\forms;

use yii\base\Model;

class LockVersionForm extends Model
{
    public $protocolType; //integer	agreement type
    public $protocolVersion;//	Int	Protocol Version
    public $scene;//	Int	Scenes
    public $groupId;//	Int	the company
    public $orgId;//	Int	Application providers

    public function rules(): array
    {
        return [
            [['protocolType', 'protocolVersion','scene','groupId','orgId'], 'required'],
            [['protocolType', 'protocolVersion','scene','groupId','orgId'], 'integer'],
        ];
    }
}