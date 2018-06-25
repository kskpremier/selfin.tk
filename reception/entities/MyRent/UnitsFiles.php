<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Unit;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "units_files".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $user_id
 * @property string $file_name
 * @property string $subject
 * @property string $notes
 * @property string $description
 * @property string $created
 * @property string $changed
 *
 * @property Units $unit
 * @property Users $user
 */
class UnitsFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_files';
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
        * @param int $user_id//
        * @param string $file_name//
        * @param string $subject//
        * @param string $notes//
        * @param string $description//
        * @param string $created//
        * @param string $changed//
        * @return UnitsFiles    */
    public static function create($id, $unit_id, $user_id, $file_name, $subject, $notes, $description, $created, $changed): UnitsFiles
    {
        $unitsFiles = new static();
                $unitsFiles->id = $id;
                $unitsFiles->unit_id = $unit_id;
                $unitsFiles->user_id = $user_id;
                $unitsFiles->file_name = $file_name;
                $unitsFiles->subject = $subject;
                $unitsFiles->notes = $notes;
                $unitsFiles->description = $description;
                $unitsFiles->created = $created;
                $unitsFiles->changed = $changed;
        
        return $unitsFiles;
    }

    /**
            * @param int $id//
            * @param int $unit_id//
            * @param int $user_id//
            * @param string $file_name//
            * @param string $subject//
            * @param string $notes//
            * @param string $description//
            * @param string $created//
            * @param string $changed//
        * @return UnitsFiles    */
    public function edit($id, $unit_id, $user_id, $file_name, $subject, $notes, $description, $created, $changed): UnitsFiles
    {

            $this->id = $id;
            $this->unit_id = $unit_id;
            $this->user_id = $user_id;
            $this->file_name = $file_name;
            $this->subject = $subject;
            $this->notes = $notes;
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
            'unit_id' => Yii::t('app', 'Unit ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'file_name' => Yii::t('app', 'File Name'),
            'subject' => Yii::t('app', 'Subject'),
            'notes' => Yii::t('app', 'Notes'),
            'description' => Yii::t('app', 'Description'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UnitsFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsFilesQuery(get_called_class());
    }
}
