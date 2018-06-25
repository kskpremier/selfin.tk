<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\UsersB2bs;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $name
 * @property int $size
 * @property string $file
 * @property string $created
 *
 * @property UsersB2b[] $usersB2bs
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
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
        * @param string $name//
        * @param int $size//
        * @param string $file//
        * @param string $created//
        * @return Files    */
    public static function create($id, $name, $size, $file, $created): Files
    {
        $files = new static();
                $files->id = $id;
                $files->name = $name;
                $files->size = $size;
                $files->file = $file;
                $files->created = $created;
        
        return $files;
    }

    /**
            * @param int $id//
            * @param string $name//
            * @param int $size//
            * @param string $file//
            * @param string $created//
        * @return Files    */
    public function edit($id, $name, $size, $file, $created): Files
    {

            $this->id = $id;
            $this->name = $name;
            $this->size = $size;
            $this->file = $file;
            $this->created = $created;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'size' => Yii::t('app', 'Size'),
            'file' => Yii::t('app', 'File'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersB2bs()
    {
        return $this->hasMany(UsersB2b::class, ['file' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\FilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\FilesQuery(get_called_class());
    }
}
