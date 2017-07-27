<?php
/**
 *
 * Created by PhpStorm.
 * User: SAS
 * Date: 27.07.17
 * Time: 17:20
 */

namespace backend\models;

use filsh\yii2\oauth2server\models\OauthAccessTokens;
use OAuth2\ResponseType\AccessTokenInterface;

class MyUserCredentials extends \OAuth2\GrantType\UserCredentials {
// переопределил функцию базового класса, чтобы она возращала готовый токен, если он есть и делала бы новый, если его нет
    public function createAccessToken(AccessTokenInterface $accessToken, $client_id, $user_id, $scope)
    {
        $token = OauthAccessTokens::find()->where(['user_id'=>$user_id,'client_id'=>$client_id,'scope'=>$scope])->andWhere(['>','expires',time()])->one();
        if (!isset($token)) {
            return parent::createAccessToken($accessToken, $client_id, $user_id, $scope);
        }
        $refreshToken = \filsh\yii2\oauth2server\models\OauthRefreshTokens::find()->where(['user_id'=>$user_id])->one();
        $result = array(
            "access_token" => $token->access_token,
            "expires_in" => strtotime($token->expires)-time(),
            "token_type" => "Bearer",
            "scope" => $token->scope,
            "refresh_token"=>$refreshToken->refresh_token
        );
        return $result;
    }

}