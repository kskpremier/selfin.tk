<?php

namespace backend\modules\faces\controllers;



use backend\modules\faces\Token;
use yii\web\Controller;




/**
 * Default controller for the `Facematica` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Get valid Token for further request and save it in AR Token
     * @return string
     */
    public function actionGetToken()
    {
        $dbToken = new \backend\models\Token();

        if ( $dbToken->getvalidToken() )
            return $this->render('index');
        else {
            $model = new Token();
            $model->getToken();
            if ($model) {
                $dbToken->expire = $model->getExpires();
                $dbToken->expire = $model->getExpires();
                $dbToken->expire = $model->getExpires();

                $dbToken->save();
            }
        }
        return $this->render('index');
    }

    /**
     * Get valid Token for further request and save it in AR Token
     * @return string
     */
    public function actionDetectFace($imageUrl)
    {

        $dbToken = new \backend\models\Token();

        if ( !$dbToken->findValidToken() ) {
            $model = new \backend\modules\faces\models\Token();

            if (isset($model)) {
                $dbToken = new \backend\models\Token();
                $dbToken->token = $model->getTokenValue();
                $dbToken->expires = strtotime($model->getExpiresValue());
                $dbToken->type = $model->getTypeValue();

                $dbToken->save();
            }
        }

        $faceModel = new FaceModel();
        $faceModel->faceDetect($imageUrl);
        if ($response->isOk) {
            $this->_token = $response->data['token'];
            $this->_expires = $response->data['expires'];
            $this->_type = $response->data['type'];
            return $this; //вернем сам токен
        }
        else   throw new \Exception('Login Failed'); //вернем сообщение об ошибке

        return $this->render('index');
    }






}
