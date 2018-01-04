<?php
namespace reception\entities\User;

use reception\entities\AggregateRoot;
use reception\entities\Apartment\Apartment;
use reception\entities\Apartment\Receptionist;
use reception\entities\Booking\Guest;
use reception\entities\EventTrait;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\Apartment\Owner;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;



/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $email_confirm_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $temporaryPassword
 * @property string $password write-only password
 * @property string $myrent_update
 * @property string $guid
 * @property string $contact_name
 * @property integer $external_id
 * @property string $contact_tel
 *
 * @property Network[] $networks
 * @property Owners[] $owners
 * @property Apartments[] $apartments
 * @property Workers[] $workers
 * @property Guest $guest
 *
 */
class User extends ActiveRecord implements AggregateRoot//implements IdentityInterface, UserCredentialsInterface
{
    use EventTrait;

//    private $user;

    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 10;

    private $temporaryPassword = null;

    public static function create(string $username, string $email, string $password, $contact_name=null, $contact_tel=null, $user_id=null, $guid=null, $updated=null): self
    {
        $user = User::find()->where(['username'=>$username,'email'=>$email])->one();
        if ($user)
//            $this->user = $user;
            return $user;
        else {
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
            $user->created_at = time();
            $user->status = self::STATUS_ACTIVE;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->temporaryPassword =$password;
            $user->contact_name = $contact_name;
            $user->contact_tel = $contact_tel;
            $user->external_id = $user_id;
//            $user->myrent_update = ($updated)?$updated:time();
            $user->guid = $guid;
            //толи хак, толи так надо я пока не понимаю
            $user->save();

            // TODO - change user->save() in USER
            return $user;
        }
    }



    public function edit(string $username, string $email): void
    {
        $this->username = $username;
        $this->email = $email;

    }

    public static function requestSignup(string $username, string $email, string $password): self
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status = self::STATUS_WAIT;
        $user->email_confirm_token = Yii::$app->security->generateRandomString();
        $user->generateAuthKey();
        $user->recordEvent(new UserSignUpRequested($user));
        return $user;
    }

    public function confirmSignup(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm_token = null;
        $this->recordEvent(new UserSignUpRequested($this));
    }

    public static function signupByNetwork($network, $identity): self
    {
        $user = new User();
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->networks = [Network::create($network, $identity)];
        return $user;
    }

    public function attachNetwork($network, $identity): void
    {
        $networks = $this->networks;
        foreach ($networks as $current) {
            if ($current->isFor($network, $identity)) {
                throw new \DomainException('Network is already attached.');
            }
        }
        $networks[] = Network::create($network, $identity);
        $this->networks = $networks;
    }

    public function requestPasswordReset(): void
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new \DomainException('Password resetting is already requested.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function resetPassword($password): void
    {
        if (empty($this->password_reset_token)) {
            throw new \DomainException('Password resetting is not requested.');
        }
        $this->setPassword($password);
        $this->password_reset_token = null;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
    public function setUpdateTime ($time)
    {
        $this->updated_at = $time;
    }
    public function setMyRentUpdateTime ($time)
    {
        $this->myrent_update = $time;
    }

    public function getNetworks(): ActiveQuery
    {
        return $this->hasMany(Network::className(), ['user_id' => 'id']);
    }

    public function getOwners(): ActiveQuery
    {
        return $this->hasMany(Owner::className(), ['user_id' => 'id']);
    }
    public function getWokers(): ActiveQuery
    {
        return $this->hasOne(Worker::className(), ['user_id' => 'id']);
    }
    public function getGuest(): ActiveQuery
    {
        return $this->hasOne(Guest::className(), ['user_id' => 'id']);
    }
    public function getApartments()
    {
        return $this->hasMany(Apartment::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['networks', 'guest','receptionist','owner'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    private function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    private function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates password string from password and sets it to the model
     *
     * @param integer $length by dafault=8
     *
     * @return string password
     */
    public static function generatePassword($length = 8) :string
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }


//    public static function findIdentity($id)
//    {
//        $user = self::getRepository()->findActiveById($id);
//        return $user ? new self($user): null;
//    }
//
//    public static function findIdentityByAccessToken($token, $type = null)
//    {
//        $data = self::getOauth()->getServer()->getResourceController()->getToken();
//        return !empty($data['user_id']) ? static::findIdentity($data['user_id']) : null;
//    }
//
//    public function getId(): int
//    {
//        return $this->user->id;
//    }
//    public function getUsername(): string
//    {
//        return $this->user->username;
//    }
//
//    public function getAuthKey(): string
//    {
//        return $this->user->auth_key;
//    }
//
//    public function validateAuthKey($authKey): bool
//    {
//        return $this->getAuthKey() === $authKey;
//    }
//
//    public function checkUserCredentials($username, $password): bool
//    {
//        if (!$user = self::getRepository()->findActiveByUsername($username)) {
//            return false;
//        }
//        return $user->validatePassword($password);
//    }
//
//    public function getUserDetails($username): array
//    {
//        $user = self::getRepository()->findActiveByUsername($username);
//        return ['user_id' => $user->id];
//    }
//
//    private static function getRepository(): UserReadRepository
//    {
//        return \Yii::$container->get(UserReadRepository::class);
//    }
//
//    private static function getOauth(): Module
//    {
//        return Yii::$app->getModule('oauth2');
//    }

}
