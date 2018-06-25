<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Blogs;
use reception\entities\MyRent\Countries;
use reception\entities\MyRent\EmailsTemplates;
use reception\entities\MyRent\LanguagesB2bs;
use reception\entities\MyRent\ObjectsPricesNotes;
use reception\entities\MyRent\ObjectsRealestatesDescriptions;
use reception\entities\MyRent\ObjectsSeos;
use reception\entities\MyRent\Reports;
use reception\entities\MyRent\UsersGeneralsTerms;
use reception\entities\MyRent\Workers;

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
     * {@inheritdoc}
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
        * @param int $id//
        * @param int $erp_id//
        * @param string $code//
        * @param string $code_iso//
        * @param string $language//
        * @param string $created//
        * @param string $changed//
        * @return Languages    */
    public static function create($id, $erp_id, $code, $code_iso, $language, $created, $changed): Languages
    {
        $languages = new static();
                $languages->id = $id;
                $languages->erp_id = $erp_id;
                $languages->code = $code;
                $languages->code_iso = $code_iso;
                $languages->language = $language;
                $languages->created = $created;
                $languages->changed = $changed;
        
        return $languages;
    }

    /**
            * @param int $id//
            * @param int $erp_id//
            * @param string $code//
            * @param string $code_iso//
            * @param string $language//
            * @param string $created//
            * @param string $changed//
        * @return Languages    */
    public function edit($id, $erp_id, $code, $code_iso, $language, $created, $changed): Languages
    {

            $this->id = $id;
            $this->erp_id = $erp_id;
            $this->code = $code;
            $this->code_iso = $code_iso;
            $this->language = $language;
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
            'erp_id' => Yii::t('app', 'Erp ID'),
            'code' => Yii::t('app', 'Code'),
            'code_iso' => Yii::t('app', 'Code Iso'),
            'language' => Yii::t('app', 'Language'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blogs::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTemplates()
    {
        return $this->hasMany(EmailsTemplates::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesB2bs()
    {
        return $this->hasMany(LanguagesB2b::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesNotes()
    {
        return $this->hasMany(ObjectsPricesNotes::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptions()
    {
        return $this->hasMany(ObjectsRealestatesDescriptions::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsSeos()
    {
        return $this->hasMany(ObjectsSeo::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Reports::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGeneralsTerms()
    {
        return $this->hasMany(UsersGeneralsTerms::class, ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::class, ['language_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LanguagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LanguagesQuery(get_called_class());
    }
}
