<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "excursions_types".
 *
 * @property int $id
 * @property int $usrer_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 */
class ExcursionsTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'excursions_types';
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
        * @param int $usrer_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ExcursionsTypes    */
    public static function create($id, $usrer_id, $code, $name, $created, $changed): ExcursionsTypes
    {
        $excursionsTypes = new static();
                $excursionsTypes->id = $id;
                $excursionsTypes->usrer_id = $usrer_id;
                $excursionsTypes->code = $code;
                $excursionsTypes->name = $name;
                $excursionsTypes->created = $created;
                $excursionsTypes->changed = $changed;
        
        return $excursionsTypes;
    }

    /**
            * @param int $id//
            * @param int $usrer_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ExcursionsTypes    */
    public function edit($id, $usrer_id, $code, $name, $created, $changed): ExcursionsTypes
    {

            $this->id = $id;
            $this->usrer_id = $usrer_id;
            $this->code = $code;
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
            'usrer_id' => Yii::t('app', 'Usrer ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ExcursionsTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ExcursionsTypesQuery(get_called_class());
    }
}
