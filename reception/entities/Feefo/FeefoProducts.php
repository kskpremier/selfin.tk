<?php


namespace reception\entities\Feefo;

use Yii;

/**
 * This is the model class for table "feefo_products".
 *
 * @property int $id
 * @property int $object_id
 * @property int $created
 * @property string $params
 */
class FeefoProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feefo_products';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @param int $id//
     * @param int $object_id//
     * @param int $created//
     * @param string $log//
     * @return FeefoProducts    */
    public static function create( $object_id, $created, $params): FeefoProducts
    {
        $feefoProducts = new static();
        $feefoProducts->object_id = $object_id;
        $feefoProducts->created = $created;
        $feefoProducts->params = json_encode($params);

        $feefoProducts->product_description  =  $params['productdescription'];
        $feefoProducts->tags                 =  $params['tags'];
        $feefoProducts->title                =  $params['title'];
        $feefoProducts->url                  =  $params['url'];
        $feefoProducts->ratable_attributes   =  $params['ratableattributes'];
        $feefoProducts->image_link           =  $params['imagelink'];
        $feefoProducts->merchant_identifier  =  $params['merchantidentifier'];
      

        return $feefoProducts;
    }

    /**
     * @param int $id//
     * @param int $object_id//
     * @param int $created//
     * @param string $log//
     * @return FeefoProducts    */
    public function edit( $object_id, $created, $params): FeefoProducts
    {
        $this->object_id = $object_id;
        $this->created = $created;
        $this->params = json_encode($params);
       $this->product_description  =  $params['productdescription'];
       $this->tags                 =  $params['tags'];
       $this->title                =  $params['title'];
       $this->url                  =  $params['url'];
       $this->ratable_attributes   =  $params['ratableattributes'];
       $this->image_link           =  $params['imagelink'];
       $this->merchant_identifier  =  $params['merchantidentifier'];

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'created' => Yii::t('app', 'Created'),
            'params' => Yii::t('app', 'For csv'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\Feefo\queries\FeefoProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\Feefo\queries\FeefoProductsQuery(get_called_class());
    }
}
