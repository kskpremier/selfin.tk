<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "rents_imports".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $user_id
 * @property int $object_id
 * @property int $rent_id
 * @property string $message
 * @property string $manual
 * @property string $changed
 * @property string $created
 *
 * @property B2b $b2b
 * @property Objects $object
 * @property Rents $rent
 * @property Users $user
 */
class RentsImports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_imports';
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
        * @param int $b2b_id//
        * @param int $user_id//
        * @param int $object_id//
        * @param int $rent_id//
        * @param string $message//
        * @param string $manual//
        * @param string $changed//
        * @param string $created//
        * @return RentsImports    */
    public static function create($id, $b2b_id, $user_id, $object_id, $rent_id, $message, $manual, $changed, $created): RentsImports
    {
        $rentsImports = new static();
                $rentsImports->id = $id;
                $rentsImports->b2b_id = $b2b_id;
                $rentsImports->user_id = $user_id;
                $rentsImports->object_id = $object_id;
                $rentsImports->rent_id = $rent_id;
                $rentsImports->message = $message;
                $rentsImports->manual = $manual;
                $rentsImports->changed = $changed;
                $rentsImports->created = $created;
        
        return $rentsImports;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $rent_id//
            * @param string $message//
            * @param string $manual//
            * @param string $changed//
            * @param string $created//
        * @return RentsImports    */
    public function edit($id, $b2b_id, $user_id, $object_id, $rent_id, $message, $manual, $changed, $created): RentsImports
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->rent_id = $rent_id;
            $this->message = $message;
            $this->manual = $manual;
            $this->changed = $changed;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'message' => Yii::t('app', 'Message'),
            'manual' => Yii::t('app', 'Manual'),
            'changed' => Yii::t('app', 'Changed'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
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
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
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
     * @return \reception\entities\MyRent\queries\RentsImportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsImportsQuery(get_called_class());
    }
}
