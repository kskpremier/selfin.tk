<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Owner;

/**
 * This is the model class for table "owners_b2b".
 *
 * @property int $id
 * @property int $owner_id
 * @property int $b2b_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Owners $owner
 */
class OwnersB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owners_b2b';
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
        * @param int $owner_id//
        * @param int $b2b_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return OwnersB2b    */
    public static function create($id, $owner_id, $b2b_id, $value, $created, $changed): OwnersB2b
    {
        $ownersB2b = new static();
                $ownersB2b->id = $id;
                $ownersB2b->owner_id = $owner_id;
                $ownersB2b->b2b_id = $b2b_id;
                $ownersB2b->value = $value;
                $ownersB2b->created = $created;
                $ownersB2b->changed = $changed;
        
        return $ownersB2b;
    }

    /**
            * @param int $id//
            * @param int $owner_id//
            * @param int $b2b_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return OwnersB2b    */
    public function edit($id, $owner_id, $b2b_id, $value, $created, $changed): OwnersB2b
    {

            $this->id = $id;
            $this->owner_id = $owner_id;
            $this->b2b_id = $b2b_id;
            $this->value = $value;
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
            'owner_id' => Yii::t('app', 'Owner ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
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
    public function getOwner()
    {
        return $this->hasOne(Owners::class, ['id' => 'owner_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\OwnersB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\OwnersB2bQuery(get_called_class());
    }
}
