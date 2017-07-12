<?php
/**
 * Created by PhpStorm.
 * User: SVRybin
 * Date: 14.4.2017.
 * Time: 2:24
 */

namespace api\controllers;

use reception\entities\User\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class UserController extends Controller
{
    public function behaviors()
    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator']['authMethods'] = [
//            HttpBasicAuth::className(),
//            HttpBearerAuth::className(),
//        ];
/*        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
*/  //      return $behaviors;
    }

    /**
     * @SWG\Get(
     *     path="/user",
     *     tags={"Profile"},
     *     description="Returns profile info",
     *     @SWG\Parameter( name = "Authorization", in="header", type = "string", required=true, description = "Access token",  @SWG\Schema(ref="#/definitions/Authorization")),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Profile")
     *     ),
     *     security={{"Bearer": {"c9c55a85ec7d672f3077aa4cfae7f9b655b016ac"}, "OAuth2": {}}}
     * )
     */
    public function actionIndex()
    {
        return User::findOne(\Yii::$app->user->id);
//        $searchModel = new UserSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        return $dataProvider;
    }

    public function actionUpdate()
    {
        $model = $this->findModel();
        $model->load(Yii::$app->request->getBodyParams(), '');
//        if ($model->save() === false && !$model->hasErrors()) {
//            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
//        }
//        return $model;
        return json_encode(Yii::$app->request->getBodyParams());
    }
    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch'],
        ];
    }
    /**
     * @return User
     */
    private function findModel()
    {
        return User::findOne(\Yii::$app->user->id);
    }
}
