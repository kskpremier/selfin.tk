<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 13:04
 */
namespace reception\forms\validators;

use yii\validators\Validator;

class KeyDatesValidator extends Validator {
    public function validateAttribute($model, $attribute){
        if ($model->type != "2"){
            if ($model->startDate < (time()-60) ){
                $this->addError($model, $attribute, 'Start Date must be bigger then current time');
            }
            if ($model->endDate < $model->startDate ){
                $this->addError($model, $attribute, 'End Date must be bigger then Start Date');
            }
        }
    }
}