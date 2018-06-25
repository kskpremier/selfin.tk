<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_seo".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $language_id
 * @property string $url_name
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $tags
 * @property string $created
 * @property string $changed
 *
 * @property Languages $language
 * @property Objects $object
 * @property Users $user
 */
class ObjectsSeo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_seo';
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
        * @param int $object_id//
        * @param int $language_id//
        * @param string $url_name//
        * @param string $title//
        * @param string $description//
        * @param string $keywords//
        * @param string $tags//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsSeo    */
    public static function create($id, $user_id, $object_id, $language_id, $url_name, $title, $description, $keywords, $tags, $created, $changed): ObjectsSeo
    {
        $objectsSeo = new static();
                $objectsSeo->id = $id;
                $objectsSeo->user_id = $user_id;
                $objectsSeo->object_id = $object_id;
                $objectsSeo->language_id = $language_id;
                $objectsSeo->url_name = $url_name;
                $objectsSeo->title = $title;
                $objectsSeo->description = $description;
                $objectsSeo->keywords = $keywords;
                $objectsSeo->tags = $tags;
                $objectsSeo->created = $created;
                $objectsSeo->changed = $changed;
        
        return $objectsSeo;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $language_id//
            * @param string $url_name//
            * @param string $title//
            * @param string $description//
            * @param string $keywords//
            * @param string $tags//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsSeo    */
    public function edit($id, $user_id, $object_id, $language_id, $url_name, $title, $description, $keywords, $tags, $created, $changed): ObjectsSeo
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->language_id = $language_id;
            $this->url_name = $url_name;
            $this->title = $title;
            $this->description = $description;
            $this->keywords = $keywords;
            $this->tags = $tags;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'url_name' => Yii::t('app', 'Url Name'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'tags' => Yii::t('app', 'Tags'),
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
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsSeoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsSeoQuery(get_called_class());
    }
}
