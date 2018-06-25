<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Users;
use reception\entities\MyRent\Users0;
use reception\entities\MyRent\Workers;

/**
 * This is the model class for table "pictures".
 *
 * @property int $id
 * @property string $name
 * @property int $size
 * @property string $picture
 * @property string $created
 *
 * @property Users[] $users
 * @property Users[] $users0
 * @property Workers[] $workers
 */
class Pictures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pictures';
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
        * @param string $picture//
        * @param string $created//
        * @return Pictures    */
    public static function create($id, $name, $size, $picture, $created): Pictures
    {
        $pictures = new static();
                $pictures->id = $id;
                $pictures->name = $name;
                $pictures->size = $size;
                $pictures->picture = $picture;
                $pictures->created = $created;
        
        return $pictures;
    }

    /**
            * @param int $id//
            * @param string $name//
            * @param int $size//
            * @param string $picture//
            * @param string $created//
        * @return Pictures    */
    public function edit($id, $name, $size, $picture, $created): Pictures
    {

            $this->id = $id;
            $this->name = $name;
            $this->size = $size;
            $this->picture = $picture;
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
            'picture' => Yii::t('app', 'Picture'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['picture_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(Users::class, ['logo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::class, ['picture_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\PicturesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\PicturesQuery(get_called_class());
    }
}
