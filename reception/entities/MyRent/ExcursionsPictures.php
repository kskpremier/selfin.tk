<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Excursions;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "excursions_pictures".
 *
 * @property int $id
 * @property int $excursions_id
 * @property int $user_id
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property Excursions $excursions
 * @property Users $user
 */
class ExcursionsPictures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'excursions_pictures';
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
        * @param int $excursions_id//
        * @param int $user_id//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ExcursionsPictures    */
    public static function create($id, $excursions_id, $user_id, $name, $created, $changed): ExcursionsPictures
    {
        $excursionsPictures = new static();
                $excursionsPictures->id = $id;
                $excursionsPictures->excursions_id = $excursions_id;
                $excursionsPictures->user_id = $user_id;
                $excursionsPictures->name = $name;
                $excursionsPictures->created = $created;
                $excursionsPictures->changed = $changed;
        
        return $excursionsPictures;
    }

    /**
            * @param int $id//
            * @param int $excursions_id//
            * @param int $user_id//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ExcursionsPictures    */
    public function edit($id, $excursions_id, $user_id, $name, $created, $changed): ExcursionsPictures
    {

            $this->id = $id;
            $this->excursions_id = $excursions_id;
            $this->user_id = $user_id;
            $this->name = $name;
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
            'excursions_id' => Yii::t('app', 'Excursions ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasOne(Excursions::class, ['id' => 'excursions_id']);
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
     * @return \reception\entities\MyRent\queries\ExcursionsPicturesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ExcursionsPicturesQuery(get_called_class());
    }
}
