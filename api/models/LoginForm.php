<?php
/**
 * Created by PhpStorm.
 * User: SVRybin
 * Date: 14.4.2017.
 * Time: 0:38
 */

namespace api\models;

use backend\models\Token;
use common\models\User;
use filsh\yii2\oauth2server\models\OauthRefreshTokens;
use yii\base\Model;
use yii\web\BadRequestHttpException;

/**
 * Login form
 *
 * @property string $username
 * @property string $password
 * @property string $client_id
 * @property string $client_secret
 * @property string $grant_type
 */
class LoginForm extends Model
{
    /**
     * @var
     */
    public $username;
    public $password;
    public $client_id = "testclient";
    public $client_secret = "testpass";
    public $grant_type = "password" ;


    private $_user;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['client_id','client_secret','grant_type'],'string'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
    /**
     * @return Token|null
     */
    public function auth()
    {

        if ($this->validate()) {
            // Check if valid token exist
            $token = Token::find()
                ->andWhere(['user_id' => $this->getUser()->id])
                ->andWhere(['>', 'expires', time()])
                ->one();
            if ($token === null) {
                return null;
            } else {
                return $token;
            }
        } else {
            throw new BadRequestHttpException("Wrong request parameters");
        }
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}