<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property int $erp_id
 * @property string $code
 * @property string $code_iso
 * @property string $language
 * @property string $created
 * @property string $changed
 *
 * @property Blogs[] $blogs
 * @property Countries[] $countries
 * @property EmailsTemplates[] $emailsTemplates
 * @property LanguagesB2b[] $languagesB2bs
 * @property ObjectsPricesNotes[] $objectsPricesNotes
 * @property ObjectsRealestatesDescriptions[] $objectsRealestatesDescriptions
 * @property ObjectsSeo[] $objectsSeos
 * @property Reports[] $reports
 * @property UsersGeneralsTerms[] $usersGeneralsTerms
 * @property Workers[] $workers
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['erp_id'], 'integer'],
            [['created', 'changed'], 'safe'],
            [['code', 'code_iso', 'language'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'erp_id' => 'Erp ID',
            'code' => 'Code',
            'code_iso' => 'Code Iso',
            'language' => 'Language',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blogs::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTemplates()
    {
        return $this->hasMany(EmailsTemplates::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesB2bs()
    {
        return $this->hasMany(LanguagesB2b::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesNotes()
    {
        return $this->hasMany(ObjectsPricesNotes::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptions()
    {
        return $this->hasMany(ObjectsRealestatesDescriptions::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsSeos()
    {
        return $this->hasMany(ObjectsSeo::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Reports::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGeneralsTerms()
    {
        return $this->hasMany(UsersGeneralsTerms::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::className(), ['language_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ObjectTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObjectTypesQuery(get_called_class());
    }
}
