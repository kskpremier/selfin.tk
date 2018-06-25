<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Country;
use reception\entities\MyRent\Currency;

/**
 * This is the model class for table "currency_list".
 *
 * @property int $id
 * @property int $country_id
 * @property int $currency_id
 * @property int $number
 * @property string $date
 * @property string $date_created
 * @property double $buy
 * @property double $middle
 * @property double $sell
 * @property string $created
 * @property string $changed
 *
 * @property Countries $country
 * @property Currency $currency
 */
class CurrencyList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency_list';
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
        * @param int $country_id//
        * @param int $currency_id//
        * @param int $number//
        * @param string $date//
        * @param string $date_created//
        * @param double $buy//
        * @param double $middle//
        * @param double $sell//
        * @param string $created//
        * @param string $changed//
        * @return CurrencyList    */
    public static function create($id, $country_id, $currency_id, $number, $date, $date_created, $buy, $middle, $sell, $created, $changed): CurrencyList
    {
        $currencyList = new static();
                $currencyList->id = $id;
                $currencyList->country_id = $country_id;
                $currencyList->currency_id = $currency_id;
                $currencyList->number = $number;
                $currencyList->date = $date;
                $currencyList->date_created = $date_created;
                $currencyList->buy = $buy;
                $currencyList->middle = $middle;
                $currencyList->sell = $sell;
                $currencyList->created = $created;
                $currencyList->changed = $changed;
        
        return $currencyList;
    }

    /**
            * @param int $id//
            * @param int $country_id//
            * @param int $currency_id//
            * @param int $number//
            * @param string $date//
            * @param string $date_created//
            * @param double $buy//
            * @param double $middle//
            * @param double $sell//
            * @param string $created//
            * @param string $changed//
        * @return CurrencyList    */
    public function edit($id, $country_id, $currency_id, $number, $date, $date_created, $buy, $middle, $sell, $created, $changed): CurrencyList
    {

            $this->id = $id;
            $this->country_id = $country_id;
            $this->currency_id = $currency_id;
            $this->number = $number;
            $this->date = $date;
            $this->date_created = $date_created;
            $this->buy = $buy;
            $this->middle = $middle;
            $this->sell = $sell;
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
            'country_id' => Yii::t('app', 'Country ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'number' => Yii::t('app', 'Number'),
            'date' => Yii::t('app', 'Date'),
            'date_created' => Yii::t('app', 'Date Created'),
            'buy' => Yii::t('app', 'Buy'),
            'middle' => Yii::t('app', 'Middle'),
            'sell' => Yii::t('app', 'Sell'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\CurrencyListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CurrencyListQuery(get_called_class());
    }
}
