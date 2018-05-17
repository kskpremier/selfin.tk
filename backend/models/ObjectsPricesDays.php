<?php

namespace backend\models;

use backend\models\query\ObjectsPricesDaysQuery;
use reception\entities\User\User;

use Yii;

/**
 * This is the model class for table "{{%objects_prices_days}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $item_id
 * @property int $group_id this is just grouping for syncing (no conenction with grouos)
 * @property int $stock available stock for selling
 * @property string $day day
 * @property string $check_in
 * @property string $check_out
 * @property double $price standard sell price
 * @property double $price_b2b sell price for B2B partners
 * @property double $price_special specal price, usual as discount
 * @property int $min_stay
 * @property int $days_before number of days before the checkin date
 * @property double $price_extra
 * @property double $price_extra_child
 * @property double $extra_from
 * @property string $enable
 * @property string $created
 * @property string $changed
 *
 * @property Items $item
 * @property Objects $object
 * @property Users $user
 */
class ObjectsPricesDays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%objects_prices_days}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

//    public static function create(PriceSetForm $form) {
//        $price = new static();
//        $price->price = $form->price;
//        $price->min_stay = $form->min_stay;
//        for ($i=0; $i< $form->id; $i++){
//
//        }
//        return $price;
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_id', 'item_id', 'group_id', 'stock', 'min_stay', 'days_before'], 'integer'],
            [['day', 'created', 'changed'], 'safe'],
            [['check_in', 'check_out', 'enable'], 'string'],
            [['price', 'price_b2b', 'price_special', 'price_extra', 'price_extra_child', 'extra_from'], 'number'],
            [['object_id', 'day', 'item_id'], 'unique', 'targetAttribute' => ['object_id', 'day', 'item_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['object_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'object_id' => 'Object ID',
            'item_id' => 'Item ID',
            'group_id' => 'Group ID',
            'stock' => 'Stock',
            'day' => 'Day',
            'check_in' => 'Check In',
            'check_out' => 'Check Out',
            'price' => 'Price',
            'price_b2b' => 'Price B2b',
            'price_special' => 'Price Special',
            'min_stay' => 'Min Stay',
            'days_before' => 'Days Before',
            'price_extra' => 'Price Extra',
            'price_extra_child' => 'Price Extra Child',
            'extra_from' => 'Extra From',
            'enable' => 'Enable',
            'created' => 'Created',
            'changed' => 'Changed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return RentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObjectsPricesDaysQuery(get_called_class());
    }
}