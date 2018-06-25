<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Rent;

/**
 * This is the model class for table "rents_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $rent_id
 * @property string $value
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Rents $rent
 */
class RentsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_b2b';
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
        * @param int $rent_id//
        * @param string $value//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return RentsB2b    */
    public static function create($id, $b2b_id, $rent_id, $value, $note, $created, $changed): RentsB2b
    {
        $rentsB2b = new static();
                $rentsB2b->id = $id;
                $rentsB2b->b2b_id = $b2b_id;
                $rentsB2b->rent_id = $rent_id;
                $rentsB2b->value = $value;
                $rentsB2b->note = $note;
                $rentsB2b->created = $created;
                $rentsB2b->changed = $changed;
        
        return $rentsB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $rent_id//
            * @param string $value//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return RentsB2b    */
    public function edit($id, $b2b_id, $rent_id, $value, $note, $created, $changed): RentsB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->rent_id = $rent_id;
            $this->value = $value;
            $this->note = $note;
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
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'rent_id' => Yii::t('app', 'Rent ID'),
            'value' => Yii::t('app', 'Value'),
            'note' => Yii::t('app', 'Note'),
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
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsB2bQuery(get_called_class());
    }
}
