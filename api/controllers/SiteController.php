<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use api\models\LoginForm;
//use api\models\test\BodyPost;
//use api\models\test\oFile;
//include "/Users/SAS/Sites/E-reception/api/models/test/oFile.php";
//include "/Users/SAS/Sites/E-reception/api/models/test/BodyPost.php";

class SiteController extends Controller
{
    public function actionIndex()
    {
        return 'api';
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }

    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}