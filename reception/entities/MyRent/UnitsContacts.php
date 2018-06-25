<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Unit;

/**
 * This is the model class for table "units_contacts".
 *
 * @property int $id
 * @property int $unit_id
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property string $note
 * @property string $created
 * @property string $changed
 *
 * @property Units $unit
 */
class UnitsContacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_contacts';
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
        * @param int $unit_id//
        * @param string $name//
        * @param string $email//
        * @param string $tel//
        * @param string $note//
        * @param string $created//
        * @param string $changed//
        * @return UnitsContacts    */
    public static function create($id, $unit_id, $name, $email, $tel, $note, $created, $changed): UnitsContacts
    {
        $unitsContacts = new static();
                $unitsContacts->id = $id;
                $unitsContacts->unit_id = $unit_id;
                $unitsContacts->name = $name;
                $unitsContacts->email = $email;
                $unitsContacts->tel = $tel;
                $unitsContacts->note = $note;
                $unitsContacts->created = $created;
                $unitsContacts->changed = $changed;
        
        return $unitsContacts;
    }

    /**
            * @param int $id//
            * @param int $unit_id//
            * @param string $name//
            * @param string $email//
            * @param string $tel//
            * @param string $note//
            * @param string $created//
            * @param string $changed//
        * @return UnitsContacts    */
    public function edit($id, $unit_id, $name, $email, $tel, $note, $created, $changed): UnitsContacts
    {

            $this->id = $id;
            $this->unit_id = $unit_id;
            $this->name = $name;
            $this->email = $email;
            $this->tel = $tel;
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'note' => Yii::t('app', 'Note'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitsContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsContactsQuery(get_called_class());
    }
}
