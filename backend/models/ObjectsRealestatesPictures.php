<?php

namespace backend\models;

use Yii;

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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_id', 'picture_size', 'piture_width', 'picture_height', 'sort', 'category_id'], 'integer'],
            [['summer', 'seasons', 'time', 'winter', 'day', 'night', 'description', 'tags'], 'string'],
            [['created', 'changed'], 'safe'],
            [['name', 'link', 'picture_name', 'path', 'full_path'], 'string', 'max' => 250],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['object_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'object_id' => 'Object ID',
            'name' => 'Name',
            'link' => 'Link',
            'picture_name' => 'Picture Name',
            'picture_size' => 'Picture Size',
            'piture_width' => 'Piture Width',
            'picture_height' => 'Picture Height',
            'sort' => 'Sort',
            'category_id' => 'Category ID',
            'summer' => 'Summer',
            'seasons' => 'Seasons',
            'time' => 'Time',
            'winter' => 'Winter',
            'day' => 'Day',
            'night' => 'Night',
            'description' => 'Description',
            'tags' => 'Tags',
            'path' => 'Path',
            'full_path' => 'Full Path',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesPicturesB2bs()
    {
        return $this->hasMany(ObjectsRealestatesPicturesB2b::className(), ['objects_realestates_pictures_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\ObjectsRealestatesPicturesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ObjectsRealestatesPicturesQuery(get_called_class());
    }
}
