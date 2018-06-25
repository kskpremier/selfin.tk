<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "amenites_languages".
 *
 * @property int $id
 * @property int $amenity_id
 * @property int $language_id
 * @property int $name
 * @property int $created
 * @property int $changes
 */
class AmenitesLanguages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amenites_languages';
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
        * @param int $amenity_id//
        * @param int $language_id//
        * @param int $name//
        * @param int $created//
        * @param int $changes//
        * @return AmenitesLanguages    */
    public static function create($id, $amenity_id, $language_id, $name, $created, $changes): AmenitesLanguages
    {
        $amenitesLanguages = new static();
                $amenitesLanguages->id = $id;
                $amenitesLanguages->amenity_id = $amenity_id;
                $amenitesLanguages->language_id = $language_id;
                $amenitesLanguages->name = $name;
                $amenitesLanguages->created = $created;
                $amenitesLanguages->changes = $changes;
        
        return $amenitesLanguages;
    }

    /**
            * @param int $id//
            * @param int $amenity_id//
            * @param int $language_id//
            * @param int $name//
            * @param int $created//
            * @param int $changes//
        * @return AmenitesLanguages    */
    public function edit($id, $amenity_id, $language_id, $name, $created, $changes): AmenitesLanguages
    {

            $this->id = $id;
            $this->amenity_id = $amenity_id;
            $this->language_id = $language_id;
            $this->name = $name;
            $this->created = $created;
            $this->changes = $changes;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'amenity_id' => Yii::t('app', 'Amenity ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changes' => Yii::t('app', 'Changes'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\AmenitesLanguagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\AmenitesLanguagesQuery(get_called_class());
    }
}
