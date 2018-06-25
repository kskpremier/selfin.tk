<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;
use reception\entities\MyRent\ObjectsRealestatesPicturesB2bs;

/**
 * This is the model class for table "objects_realestates_pictures".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property string $name
 * @property string $link link to the picture
 * @property string $picture_name
 * @property int $picture_size
 * @property int $piture_width
 * @property int $picture_height
 * @property int $sort
 * @property int $category_id
 * @property string $summer
 * @property string $seasons
 * @property string $time
 * @property string $winter
 * @property string $day
 * @property string $night
 * @property string $description
 * @property string $tags
 * @property string $path
 * @property string $full_path
 * @property string $created
 * @property string $changed
 *
 * @property Objects $object
 * @property Users $user
 * @property ObjectsRealestatesPicturesB2b[] $objectsRealestatesPicturesB2bs
 */
class ObjectsRealestatesPictures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_realestates_pictures';
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
        * @param string $name//
        * @param string $link// link to the picture
        * @param string $picture_name//
        * @param int $picture_size//
        * @param int $piture_width//
        * @param int $picture_height//
        * @param int $sort//
        * @param int $category_id//
        * @param string $summer//
        * @param string $seasons//
        * @param string $time//
        * @param string $winter//
        * @param string $day//
        * @param string $night//
        * @param string $description//
        * @param string $tags//
        * @param string $path//
        * @param string $full_path//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsRealestatesPictures    */
    public static function create($id, $user_id, $object_id, $name, $link, $picture_name, $picture_size, $piture_width, $picture_height, $sort, $category_id, $summer, $seasons, $time, $winter, $day, $night, $description, $tags, $path, $full_path, $created, $changed): ObjectsRealestatesPictures
    {
        $objectsRealestatesPictures = new static();
                $objectsRealestatesPictures->id = $id;
                $objectsRealestatesPictures->user_id = $user_id;
                $objectsRealestatesPictures->object_id = $object_id;
                $objectsRealestatesPictures->name = $name;
                $objectsRealestatesPictures->link = $link;
                $objectsRealestatesPictures->picture_name = $picture_name;
                $objectsRealestatesPictures->picture_size = $picture_size;
                $objectsRealestatesPictures->piture_width = $piture_width;
                $objectsRealestatesPictures->picture_height = $picture_height;
                $objectsRealestatesPictures->sort = $sort;
                $objectsRealestatesPictures->category_id = $category_id;
                $objectsRealestatesPictures->summer = $summer;
                $objectsRealestatesPictures->seasons = $seasons;
                $objectsRealestatesPictures->time = $time;
                $objectsRealestatesPictures->winter = $winter;
                $objectsRealestatesPictures->day = $day;
                $objectsRealestatesPictures->night = $night;
                $objectsRealestatesPictures->description = $description;
                $objectsRealestatesPictures->tags = $tags;
                $objectsRealestatesPictures->path = $path;
                $objectsRealestatesPictures->full_path = $full_path;
                $objectsRealestatesPictures->created = $created;
                $objectsRealestatesPictures->changed = $changed;
        
        return $objectsRealestatesPictures;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param string $name//
            * @param string $link// link to the picture
            * @param string $picture_name//
            * @param int $picture_size//
            * @param int $piture_width//
            * @param int $picture_height//
            * @param int $sort//
            * @param int $category_id//
            * @param string $summer//
            * @param string $seasons//
            * @param string $time//
            * @param string $winter//
            * @param string $day//
            * @param string $night//
            * @param string $description//
            * @param string $tags//
            * @param string $path//
            * @param string $full_path//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsRealestatesPictures    */
    public function edit($id, $user_id, $object_id, $name, $link, $picture_name, $picture_size, $piture_width, $picture_height, $sort, $category_id, $summer, $seasons, $time, $winter, $day, $night, $description, $tags, $path, $full_path, $created, $changed): ObjectsRealestatesPictures
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->name = $name;
            $this->link = $link;
            $this->picture_name = $picture_name;
            $this->picture_size = $picture_size;
            $this->piture_width = $piture_width;
            $this->picture_height = $picture_height;
            $this->sort = $sort;
            $this->category_id = $category_id;
            $this->summer = $summer;
            $this->seasons = $seasons;
            $this->time = $time;
            $this->winter = $winter;
            $this->day = $day;
            $this->night = $night;
            $this->description = $description;
            $this->tags = $tags;
            $this->path = $path;
            $this->full_path = $full_path;
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
            'name' => Yii::t('app', 'Name'),
            'link' => Yii::t('app', 'Link'),
            'picture_name' => Yii::t('app', 'Picture Name'),
            'picture_size' => Yii::t('app', 'Picture Size'),
            'piture_width' => Yii::t('app', 'Piture Width'),
            'picture_height' => Yii::t('app', 'Picture Height'),
            'sort' => Yii::t('app', 'Sort'),
            'category_id' => Yii::t('app', 'Category ID'),
            'summer' => Yii::t('app', 'Summer'),
            'seasons' => Yii::t('app', 'Seasons'),
            'time' => Yii::t('app', 'Time'),
            'winter' => Yii::t('app', 'Winter'),
            'day' => Yii::t('app', 'Day'),
            'night' => Yii::t('app', 'Night'),
            'description' => Yii::t('app', 'Description'),
            'tags' => Yii::t('app', 'Tags'),
            'path' => Yii::t('app', 'Path'),
            'full_path' => Yii::t('app', 'Full Path'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesPicturesB2bs()
    {
        return $this->hasMany(ObjectsRealestatesPicturesB2b::class, ['objects_realestates_pictures_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ObjectsRealestatesPicturesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsRealestatesPicturesQuery(get_called_class());
    }
}
