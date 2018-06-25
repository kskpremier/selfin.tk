<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\CustomerGroup;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\ReportType;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "reports".
 *
 * @property int $id
 * @property int $user_id
 * @property int $language_id
 * @property int $customer_group_id
 * @property int $report_type_id
 * @property string $type
 * @property string $description
 * @property string $color
 * @property string $name
 * @property string $report
 * @property string $created
 * @property string $changed
 *
 * @property InvoicesHeader[] $invoicesHeaders
 * @property CustomersGroups $customerGroup
 * @property Languages $language
 * @property ReportsTypes $reportType
 * @property Users $user
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reports';
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
        * @param int $language_id//
        * @param int $customer_group_id//
        * @param int $report_type_id//
        * @param string $type//
        * @param string $description//
        * @param string $color//
        * @param string $name//
        * @param string $report//
        * @param string $created//
        * @param string $changed//
        * @return Reports    */
    public static function create($id, $user_id, $language_id, $customer_group_id, $report_type_id, $type, $description, $color, $name, $report, $created, $changed): Reports
    {
        $reports = new static();
                $reports->id = $id;
                $reports->user_id = $user_id;
                $reports->language_id = $language_id;
                $reports->customer_group_id = $customer_group_id;
                $reports->report_type_id = $report_type_id;
                $reports->type = $type;
                $reports->description = $description;
                $reports->color = $color;
                $reports->name = $name;
                $reports->report = $report;
                $reports->created = $created;
                $reports->changed = $changed;
        
        return $reports;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $language_id//
            * @param int $customer_group_id//
            * @param int $report_type_id//
            * @param string $type//
            * @param string $description//
            * @param string $color//
            * @param string $name//
            * @param string $report//
            * @param string $created//
            * @param string $changed//
        * @return Reports    */
    public function edit($id, $user_id, $language_id, $customer_group_id, $report_type_id, $type, $description, $color, $name, $report, $created, $changed): Reports
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->language_id = $language_id;
            $this->customer_group_id = $customer_group_id;
            $this->report_type_id = $report_type_id;
            $this->type = $type;
            $this->description = $description;
            $this->color = $color;
            $this->name = $name;
            $this->report = $report;
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
            'language_id' => Yii::t('app', 'Language ID'),
            'customer_group_id' => Yii::t('app', 'Customer Group ID'),
            'report_type_id' => Yii::t('app', 'Report Type ID'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'color' => Yii::t('app', 'Color'),
            'name' => Yii::t('app', 'Name'),
            'report' => Yii::t('app', 'Report'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['report_id_default' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomersGroups::class, ['id' => 'customer_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportType()
    {
        return $this->hasOne(ReportsTypes::class, ['id' => 'report_type_id']);
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
     * @return \reception\entities\MyRent\queries\ReportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ReportsQuery(get_called_class());
    }
}
