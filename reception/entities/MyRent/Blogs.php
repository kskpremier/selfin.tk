<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\User;
use reception\entities\MyRent\Worker;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_id
 * @property int $language_id
 * @property string $group
 * @property string $keywords
 * @property string $picture_main
 * @property string $description
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $tags
 * @property string $content
 * @property string $content_short
 * @property string $title
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property Languages $language
 * @property Users $user
 * @property Workers $worker
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs';
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
        * @param int $worker_id//
        * @param int $language_id//
        * @param string $group//
        * @param string $keywords//
        * @param string $picture_main//
        * @param string $description//
        * @param string $type//
        * @param string $code//
        * @param string $name//
        * @param string $tags//
        * @param string $content//
        * @param string $content_short//
        * @param string $title//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return Blogs    */
    public static function create($id, $user_id, $worker_id, $language_id, $group, $keywords, $picture_main, $description, $type, $code, $name, $tags, $content, $content_short, $title, $active, $created, $changed): Blogs
    {
        $blogs = new static();
                $blogs->id = $id;
                $blogs->user_id = $user_id;
                $blogs->worker_id = $worker_id;
                $blogs->language_id = $language_id;
                $blogs->group = $group;
                $blogs->keywords = $keywords;
                $blogs->picture_main = $picture_main;
                $blogs->description = $description;
                $blogs->type = $type;
                $blogs->code = $code;
                $blogs->name = $name;
                $blogs->tags = $tags;
                $blogs->content = $content;
                $blogs->content_short = $content_short;
                $blogs->title = $title;
                $blogs->active = $active;
                $blogs->created = $created;
                $blogs->changed = $changed;
        
        return $blogs;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_id//
            * @param int $language_id//
            * @param string $group//
            * @param string $keywords//
            * @param string $picture_main//
            * @param string $description//
            * @param string $type//
            * @param string $code//
            * @param string $name//
            * @param string $tags//
            * @param string $content//
            * @param string $content_short//
            * @param string $title//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return Blogs    */
    public function edit($id, $user_id, $worker_id, $language_id, $group, $keywords, $picture_main, $description, $type, $code, $name, $tags, $content, $content_short, $title, $active, $created, $changed): Blogs
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_id = $worker_id;
            $this->language_id = $language_id;
            $this->group = $group;
            $this->keywords = $keywords;
            $this->picture_main = $picture_main;
            $this->description = $description;
            $this->type = $type;
            $this->code = $code;
            $this->name = $name;
            $this->tags = $tags;
            $this->content = $content;
            $this->content_short = $content_short;
            $this->title = $title;
            $this->active = $active;
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
            'worker_id' => Yii::t('app', 'Worker ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'group' => Yii::t('app', 'Group'),
            'keywords' => Yii::t('app', 'Keywords'),
            'picture_main' => Yii::t('app', 'Picture Main'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'tags' => Yii::t('app', 'Tags'),
            'content' => Yii::t('app', 'Content'),
            'content_short' => Yii::t('app', 'Content Short'),
            'title' => Yii::t('app', 'Title'),
            'active' => Yii::t('app', 'Active'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Workers::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\BlogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\BlogsQuery(get_called_class());
    }
}
