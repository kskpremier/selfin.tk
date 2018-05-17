<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 14.06.17
 * Time: 23:55
 */

namespace api\controllers;

use Yii;
use api\helpers\DateHelper;
use reception\entities\User\User;
use reception\helpers\UserHelper;
use yii\helpers\Url;
use yii\rest\Controller;

class AtraveoController extends Controller
{


    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
       // \Yii::$app->response->formatters = ['FORMAT_XML'=>['rootTag'=>'Response']];
        $items = ['StartDate'=> '2018-01-21', 'Vacancy'=>"N"];
        return $items;
    }

}
