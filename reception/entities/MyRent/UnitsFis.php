<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Unit;

/**
 * This is the model class for table "units_fis".
 *
 * @property int $id
 * @property int $unit_id
 * @property string $code
 * @property string $company_id
 * @property string $active
 * @property string $settlement
 * @property string $township
 * @property string $work_time
 * @property string $status
 * @property string $request
 * @property string $adress
 * @property string $adress_number
 * @property string $city
 * @property string $city_zip
 * @property string $response
 * @property int $request_time
 * @property string $message extracted mesage
 * @property string $created
 * @property string $changed
 *
 * @property Units $unit
 */
class UnitsFis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_fis';
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
        * @param string $code//
        * @param string $company_id//
        * @param string $active//
        * @param string $settlement//
        * @param string $township//
        * @param string $work_time//
        * @param string $status//
        * @param string $request//
        * @param string $adress//
        * @param string $adress_number//
        * @param string $city//
        * @param string $city_zip//
        * @param string $response//
        * @param int $request_time//
        * @param string $message// extracted mesage
        * @param string $created//
        * @param string $changed//
        * @return UnitsFis    */
    public static function create($id, $unit_id, $code, $company_id, $active, $settlement, $township, $work_time, $status, $request, $adress, $adress_number, $city, $city_zip, $response, $request_time, $message, $created, $changed): UnitsFis
    {
        $unitsFis = new static();
                $unitsFis->id = $id;
                $unitsFis->unit_id = $unit_id;
                $unitsFis->code = $code;
                $unitsFis->company_id = $company_id;
                $unitsFis->active = $active;
                $unitsFis->settlement = $settlement;
                $unitsFis->township = $township;
                $unitsFis->work_time = $work_time;
                $unitsFis->status = $status;
                $unitsFis->request = $request;
                $unitsFis->adress = $adress;
                $unitsFis->adress_number = $adress_number;
                $unitsFis->city = $city;
                $unitsFis->city_zip = $city_zip;
                $unitsFis->response = $response;
                $unitsFis->request_time = $request_time;
                $unitsFis->message = $message;
                $unitsFis->created = $created;
                $unitsFis->changed = $changed;
        
        return $unitsFis;
    }

    /**
            * @param int $id//
            * @param int $unit_id//
            * @param string $code//
            * @param string $company_id//
            * @param string $active//
            * @param string $settlement//
            * @param string $township//
            * @param string $work_time//
            * @param string $status//
            * @param string $request//
            * @param string $adress//
            * @param string $adress_number//
            * @param string $city//
            * @param string $city_zip//
            * @param string $response//
            * @param int $request_time//
            * @param string $message// extracted mesage
            * @param string $created//
            * @param string $changed//
        * @return UnitsFis    */
    public function edit($id, $unit_id, $code, $company_id, $active, $settlement, $township, $work_time, $status, $request, $adress, $adress_number, $city, $city_zip, $response, $request_time, $message, $created, $changed): UnitsFis
    {

            $this->id = $id;
            $this->unit_id = $unit_id;
            $this->code = $code;
            $this->company_id = $company_id;
            $this->active = $active;
            $this->settlement = $settlement;
            $this->township = $township;
            $this->work_time = $work_time;
            $this->status = $status;
            $this->request = $request;
            $this->adress = $adress;
            $this->adress_number = $adress_number;
            $this->city = $city;
            $this->city_zip = $city_zip;
            $this->response = $response;
            $this->request_time = $request_time;
            $this->message = $message;
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
            'code' => Yii::t('app', 'Code'),
            'company_id' => Yii::t('app', 'Company ID'),
            'active' => Yii::t('app', 'Active'),
            'settlement' => Yii::t('app', 'Settlement'),
            'township' => Yii::t('app', 'Township'),
            'work_time' => Yii::t('app', 'Work Time'),
            'status' => Yii::t('app', 'Status'),
            'request' => Yii::t('app', 'Request'),
            'adress' => Yii::t('app', 'Adress'),
            'adress_number' => Yii::t('app', 'Adress Number'),
            'city' => Yii::t('app', 'City'),
            'city_zip' => Yii::t('app', 'City Zip'),
            'response' => Yii::t('app', 'Response'),
            'request_time' => Yii::t('app', 'Request Time'),
            'message' => Yii::t('app', 'Message'),
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
     * @return \reception\entities\MyRent\queries\UnitsFisQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UnitsFisQuery(get_called_class());
    }
}
