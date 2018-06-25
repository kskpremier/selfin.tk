<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Reports;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "reports_types".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property string $created
 * @property string $changed
 *
 * @property Reports[] $reports
 * @property Users $user
 */
class ReportsTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reports_types';
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
        * @param int $user_id//
        * @param string $code//
        * @param string $name//
        * @param string $created//
        * @param string $changed//
        * @return ReportsTypes    */
    public static function create($id, $user_id, $code, $name, $created, $changed): ReportsTypes
    {
        $reportsTypes = new static();
                $reportsTypes->id = $id;
                $reportsTypes->user_id = $user_id;
                $reportsTypes->code = $code;
                $reportsTypes->name = $name;
                $reportsTypes->created = $created;
                $reportsTypes->changed = $changed;
        
        return $reportsTypes;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $code//
            * @param string $name//
            * @param string $created//
            * @param string $changed//
        * @return ReportsTypes    */
    public function edit($id, $user_id, $code, $name, $created, $changed): ReportsTypes
    {

            $this->id = $id;
            $this->user_id = $user_id;
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
            'user_id' => Yii::t('app', 'User ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Reports::class, ['report_type_id' => 'id']);
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
     * @return \reception\entities\MyRent\queries\ReportsTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ReportsTypesQuery(get_called_class());
    }
}
