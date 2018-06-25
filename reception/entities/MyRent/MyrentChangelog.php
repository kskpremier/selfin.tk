<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "myrent_changelog".
 *
 * @property int $id
 * @property string $version
 * @property string $type
 * @property string $subject
 * @property string $description
 * @property string $created
 * @property string $changed
 */
class MyrentChangelog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'myrent_changelog';
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
        * @param string $version//
        * @param string $type//
        * @param string $subject//
        * @param string $description//
        * @param string $created//
        * @param string $changed//
        * @return MyrentChangelog    */
    public static function create($id, $version, $type, $subject, $description, $created, $changed): MyrentChangelog
    {
        $myrentChangelog = new static();
                $myrentChangelog->id = $id;
                $myrentChangelog->version = $version;
                $myrentChangelog->type = $type;
                $myrentChangelog->subject = $subject;
                $myrentChangelog->description = $description;
                $myrentChangelog->created = $created;
                $myrentChangelog->changed = $changed;
        
        return $myrentChangelog;
    }

    /**
            * @param int $id//
            * @param string $version//
            * @param string $type//
            * @param string $subject//
            * @param string $description//
            * @param string $created//
            * @param string $changed//
        * @return MyrentChangelog    */
    public function edit($id, $version, $type, $subject, $description, $created, $changed): MyrentChangelog
    {

            $this->id = $id;
            $this->version = $version;
            $this->type = $type;
            $this->subject = $subject;
            $this->description = $description;
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
            'version' => Yii::t('app', 'Version'),
            'type' => Yii::t('app', 'Type'),
            'subject' => Yii::t('app', 'Subject'),
            'description' => Yii::t('app', 'Description'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\MyrentChangelogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\MyrentChangelogQuery(get_called_class());
    }
}
