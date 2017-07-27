<?php

namespace api\controllers;

/**
 * @SWG\Swagger(
 *     basePath="/",
 *     host="restapi.domouprav.hr",
 *     schemes={"http"},
 *     produces={"application/json","application/json"},
 *     consumes={"application/json","application/json"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Door lock management API",
 *         description="HTTP JSON API",
 *     ),
 *     @SWG\SecurityScheme(
 *         securityDefinition="OAuth2",
 *         type="oauth2",
 *         flow="password",
 *         tokenUrl="http://restapi.domouprav.hr/oauth2/token"
 *     ),
 *     @SWG\SecurityScheme(
 *         securityDefinition="Bearer",
 *         type="apiKey",
 *         name="Authorization",
 *         in="header"
 *     ),
 *     @SWG\Definition(
 *         definition="ErrorModel",
 *         type="object",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

use Yii;
use yii\helpers\Url;
use yii\rest\Controller;
use api\models\LoginForm;
//use api\models\test\BodyPost;
//use api\models\test\oFile;
//include "/Users/SAS/Sites/E-reception/api/models/test/oFile.php";
//include "/Users/SAS/Sites/E-reception/api/models/test/BodyPost.php";

class SiteController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/",
     *     tags={"Info"},
     *     @SWG\Response(
     *         response="200",
     *         description="API version",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="version", type="string")
     *         ),
     *     )
     * )
     */

    public function actionIndex()
    {
        return [
            'version' => '1.0.0',
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $this->serializeToken($token);
        } else {
           return $this->redirect(['oauth2/rest/token',Yii::$app->request->bodyParams]);
        }
    }
    private function serializeToken($token)
    {
        $refresh_token = \backend\models\OauthRefreshTokens::find()->where(['user_id'=>$token->user_id])->one();
        return [
            "access_token"=>$token->access_token,
            "token_type"=> "Bearer",
            "refresh_token"=> $refresh_token->refresh_token,
            "expires_in"=> strtotime($token->expires)-time()
        ];
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}

/**
 * @SWG\Post(
 *     path="/auth",
 *     tags={"Auth"},
 *     description="Authentification of user - by standard Oauth 2.0 approach",
 *     @SWG\Parameter( name = "Request for token", in="body", required=true, description = "User data",  @SWG\Schema(ref="#/definitions/Token")),
 *     @SWG\Response(
 *         response="200",
 *         description="Valid access token data",
 *         @SWG\Schema(ref="#/definitions/TokenData")
 *         ),
 *     )
 * )
 */
/**
 *  @SWG\Definition(
 *     definition="Token",
 *     type="object",
 *     required= {
 *          "username",
 *          "password",
 *          "grant_type",
 *           "client_id",
 *           "client_secret",
 *      },
 *
 *     @SWG\Property(property="grant_type", type="string", description = "Type of auth - password or token",example="password"),
 *     @SWG\Property(property="username", type="string", description = "Login username for DoorLock management system",example="myRent"),
 *     @SWG\Property(property="password", type="string", description = "Password for DoorLock management system",example="myRentmyRent"),
 *     @SWG\Property(property="client_id", type="string", description = "right now could be equal default value",example="myRent"),
 *     @SWG\Property(property="client_secret", type="string", description = "External booking identity",example="testpass"),
 * )
 */

/**
 *  @SWG\Definition(
 *     definition="TokenData",
 *     type="object",
 *     required={
 *      },
 *     @SWG\Property(property="access_token", type="integer",description = "Internal booking door lock identity", example="bsAo_jbsPUPCpibo3mxx3m-sFYzjIGsI"),
 *     @SWG\Property(property="token_type", type="integer", description = "Type of token", example="Bearer"),
 *     @SWG\Property(property="refresh_token", type="integer" ,description = "Token for refreshing expired one", example="ohWo1ohr"),
 *     @SWG\Property(property="expires_in", type="integer",description = "Digital code for opening the door lock", example="86400"),
 *     @SWG\Property(property="scope", type="string",description = "Scope of actions for this token", example="booking,door lock"),
 * )
 */

