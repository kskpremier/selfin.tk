<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "users_generals_terms".
 *
 * @property int $id
 * @property int $user_id
 * @property int $language_id
 * @property string $url
 * @property string $terms
 * @property string $created
 * @property string $changed
 *
 * @property Languages $language
 * @property Users $user
 */
class UsersGeneralsTerms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_generals_terms';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $user_id//
        * @param int $language_id//
        * @param string $url//
        * @param string $terms//
        * @param string $created//
        * @param string $changed//
        * @return UsersGeneralsTerms    */
    public static function create($id, $user_id, $language_id, $url, $terms, $created, $changed): UsersGeneralsTerms
    {
        $usersGeneralsTerms = new static();
                $usersGeneralsTerms->id = $id;
                $usersGeneralsTerms->user_id = $user_id;
                $usersGeneralsTerms->language_id = $language_id;
                $usersGeneralsTerms->url = $url;
                $usersGeneralsTerms->terms = $terms;
                $usersGeneralsTerms->created = $created;
                $usersGeneralsTerms->changed = $changed;
        
        return $usersGeneralsTerms;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $language_id//
            * @param string $url//
            * @param string $terms//
            * @param string $created//
            * @param string $changed//
        * @return UsersGeneralsTerms    */
    public function edit($id, $user_id, $language_id, $url, $terms, $created, $changed): UsersGeneralsTerms
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->language_id = $language_id;
            $this->url = $url;
            $this->terms = $terms;
            $this->created = $created;
            $this->changed = $changed;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'url' => Yii::t('app', 'Url'),
            'terms' => Yii::t('app', 'Terms'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersGeneralsTermsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersGeneralsTermsQuery(get_called_class());
    }
}
