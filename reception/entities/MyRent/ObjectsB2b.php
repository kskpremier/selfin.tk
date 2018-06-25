<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Object;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_b2b".
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property int $b2b_id
 * @property string $value
 * @property string $price_type add price type
 * @property string $username
 * @property string $password
 * @property double $price_percent how we send it to b2b
 * @property double $option1 option1
 * @property string $tolken
 * @property string $web
 * @property string $response
 * @property string $url_activation
 * @property string $price_id
 * @property string $share_content
 * @property string $single_room_active
 * @property string $error stop if we have error
 * @property string $error_msg error message
 * @property string $error_created when was error created
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Objects $object
 * @property Users $user
 */
class ObjectsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_b2b';
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
        * @param int $object_id//
        * @param int $b2b_id//
        * @param string $value//
        * @param string $price_type// add price type
        * @param string $username//
        * @param string $password//
        * @param double $price_percent// how we send it to b2b
        * @param double $option1// option1
        * @param string $tolken//
        * @param string $web//
        * @param string $response//
        * @param string $url_activation//
        * @param string $price_id//
        * @param string $share_content//
        * @param string $single_room_active//
        * @param string $error// stop if we have error
        * @param string $error_msg// error message
        * @param string $error_created// when was error created
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsB2b    */
    public static function create($id, $user_id, $object_id, $b2b_id, $value, $price_type, $username, $password, $price_percent, $option1, $tolken, $web, $response, $url_activation, $price_id, $share_content, $single_room_active, $error, $error_msg, $error_created, $active, $created, $changed): ObjectsB2b
    {
        $objectsB2b = new static();
                $objectsB2b->id = $id;
                $objectsB2b->user_id = $user_id;
                $objectsB2b->object_id = $object_id;
                $objectsB2b->b2b_id = $b2b_id;
                $objectsB2b->value = $value;
                $objectsB2b->price_type = $price_type;
                $objectsB2b->username = $username;
                $objectsB2b->password = $password;
                $objectsB2b->price_percent = $price_percent;
                $objectsB2b->option1 = $option1;
                $objectsB2b->tolken = $tolken;
                $objectsB2b->web = $web;
                $objectsB2b->response = $response;
                $objectsB2b->url_activation = $url_activation;
                $objectsB2b->price_id = $price_id;
                $objectsB2b->share_content = $share_content;
                $objectsB2b->single_room_active = $single_room_active;
                $objectsB2b->error = $error;
                $objectsB2b->error_msg = $error_msg;
                $objectsB2b->error_created = $error_created;
                $objectsB2b->active = $active;
                $objectsB2b->created = $created;
                $objectsB2b->changed = $changed;
        
        return $objectsB2b;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $object_id//
            * @param int $b2b_id//
            * @param string $value//
            * @param string $price_type// add price type
            * @param string $username//
            * @param string $password//
            * @param double $price_percent// how we send it to b2b
            * @param double $option1// option1
            * @param string $tolken//
            * @param string $web//
            * @param string $response//
            * @param string $url_activation//
            * @param string $price_id//
            * @param string $share_content//
            * @param string $single_room_active//
            * @param string $error// stop if we have error
            * @param string $error_msg// error message
            * @param string $error_created// when was error created
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsB2b    */
    public function edit($id, $user_id, $object_id, $b2b_id, $value, $price_type, $username, $password, $price_percent, $option1, $tolken, $web, $response, $url_activation, $price_id, $share_content, $single_room_active, $error, $error_msg, $error_created, $active, $created, $changed): ObjectsB2b
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->object_id = $object_id;
            $this->b2b_id = $b2b_id;
            $this->value = $value;
            $this->price_type = $price_type;
            $this->username = $username;
            $this->password = $password;
            $this->price_percent = $price_percent;
            $this->option1 = $option1;
            $this->tolken = $tolken;
            $this->web = $web;
            $this->response = $response;
            $this->url_activation = $url_activation;
            $this->price_id = $price_id;
            $this->share_content = $share_content;
            $this->single_room_active = $single_room_active;
            $this->error = $error;
            $this->error_msg = $error_msg;
            $this->error_created = $error_created;
            $this->active = $active;
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
            'object_id' => Yii::t('app', 'Object ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'value' => Yii::t('app', 'Value'),
            'price_type' => Yii::t('app', 'Price Type'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'price_percent' => Yii::t('app', 'Price Percent'),
            'option1' => Yii::t('app', 'Option1'),
            'tolken' => Yii::t('app', 'Tolken'),
            'web' => Yii::t('app', 'Web'),
            'response' => Yii::t('app', 'Response'),
            'url_activation' => Yii::t('app', 'Url Activation'),
            'price_id' => Yii::t('app', 'Price ID'),
            'share_content' => Yii::t('app', 'Share Content'),
            'single_room_active' => Yii::t('app', 'Single Room Active'),
            'error' => Yii::t('app', 'Error'),
            'error_msg' => Yii::t('app', 'Error Msg'),
            'error_created' => Yii::t('app', 'Error Created'),
            'active' => Yii::t('app', 'Active'),
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
    public function getObject()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsB2bQuery(get_called_class());
    }
}
