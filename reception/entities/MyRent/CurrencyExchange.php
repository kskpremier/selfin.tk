<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Currency;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "currency_exchange".
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property double $rate exchange rate
 *
 * @property Currency $currency
 * @property Users $user
 */
class CurrencyExchange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency_exchange';
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
        * @param int $currency_id//
        * @param double $rate// exchange rate
        * @return CurrencyExchange    */
    public static function create($id, $user_id, $currency_id, $rate): CurrencyExchange
    {
        $currencyExchange = new static();
                $currencyExchange->id = $id;
                $currencyExchange->user_id = $user_id;
                $currencyExchange->currency_id = $currency_id;
                $currencyExchange->rate = $rate;
        
        return $currencyExchange;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $currency_id//
            * @param double $rate// exchange rate
        * @return CurrencyExchange    */
    public function edit($id, $user_id, $currency_id, $rate): CurrencyExchange
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->currency_id = $currency_id;
            $this->rate = $rate;
    
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
            'currency_id' => Yii::t('app', 'Currency ID'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
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
     * @return \reception\entities\MyRent\queries\CurrencyExchangeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\CurrencyExchangeQuery(get_called_class());
    }
}
