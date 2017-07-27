<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 27.07.17
 * Time: 11:09
 */

namespace backend\models;

use filsh\yii2\oauth2server\models\OauthClients;
use Yii;

/**
 * This is the model class for table "oauth_refresh_tokens".
 *
 * @property string $refresh_token
 * @property string $client_id
 * @property integer $user_id
 * @property string $expires
 * @property string $scope
 *
 * @property OauthClients $client
 */
class OauthRefreshTokens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_refresh_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['refresh_token', 'client_id'], 'required'],
            [['user_id'], 'integer'],
            [['expires'], 'safe'],
            [['refresh_token'], 'string', 'max' => 40],
            [['client_id'], 'string', 'max' => 32],
            [['scope'], 'string', 'max' => 2000],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => OauthClients::className(), 'targetAttribute' => ['client_id' => 'client_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'refresh_token' => 'Refresh Token',
            'client_id' => 'Client ID',
            'user_id' => 'User ID',
            'expires' => 'Expires',
            'scope' => 'Scope',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(OauthClients::className(), ['client_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function fields()
    {
        return ['refresh_token'=>$this->refresh_token];
    }
}
