<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Group;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "objects_groups_b2b".
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property int $b2b_id
 * @property string $value
 * @property string $tolken
 * @property string $web
 * @property string $price_id
 * @property string $username
 * @property string $password
 * @property string $price_type put here price type
 * @property double $percent
 * @property double $price1_percent
 * @property double $people_max max number of people, use to generate price for number of guests
 * @property string $single_price_active
 * @property string $active
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property ObjectsGroups $group
 * @property Users $user
 */
class ObjectsGroupsB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_groups_b2b';
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
        * @param int $group_id//
        * @param int $b2b_id//
        * @param string $value//
        * @param string $tolken//
        * @param string $web//
        * @param string $price_id//
        * @param string $username//
        * @param string $password//
        * @param string $price_type// put here price type
        * @param double $percent//
        * @param double $price1_percent//
        * @param double $people_max// max number of people, use to generate price for number of guests
        * @param string $single_price_active//
        * @param string $active//
        * @param string $created//
        * @param string $changed//
        * @return ObjectsGroupsB2b    */
    public static function create($id, $user_id, $group_id, $b2b_id, $value, $tolken, $web, $price_id, $username, $password, $price_type, $percent, $price1_percent, $people_max, $single_price_active, $active, $created, $changed): ObjectsGroupsB2b
    {
        $objectsGroupsB2b = new static();
                $objectsGroupsB2b->id = $id;
                $objectsGroupsB2b->user_id = $user_id;
                $objectsGroupsB2b->group_id = $group_id;
                $objectsGroupsB2b->b2b_id = $b2b_id;
                $objectsGroupsB2b->value = $value;
                $objectsGroupsB2b->tolken = $tolken;
                $objectsGroupsB2b->web = $web;
                $objectsGroupsB2b->price_id = $price_id;
                $objectsGroupsB2b->username = $username;
                $objectsGroupsB2b->password = $password;
                $objectsGroupsB2b->price_type = $price_type;
                $objectsGroupsB2b->percent = $percent;
                $objectsGroupsB2b->price1_percent = $price1_percent;
                $objectsGroupsB2b->people_max = $people_max;
                $objectsGroupsB2b->single_price_active = $single_price_active;
                $objectsGroupsB2b->active = $active;
                $objectsGroupsB2b->created = $created;
                $objectsGroupsB2b->changed = $changed;
        
        return $objectsGroupsB2b;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $group_id//
            * @param int $b2b_id//
            * @param string $value//
            * @param string $tolken//
            * @param string $web//
            * @param string $price_id//
            * @param string $username//
            * @param string $password//
            * @param string $price_type// put here price type
            * @param double $percent//
            * @param double $price1_percent//
            * @param double $people_max// max number of people, use to generate price for number of guests
            * @param string $single_price_active//
            * @param string $active//
            * @param string $created//
            * @param string $changed//
        * @return ObjectsGroupsB2b    */
    public function edit($id, $user_id, $group_id, $b2b_id, $value, $tolken, $web, $price_id, $username, $password, $price_type, $percent, $price1_percent, $people_max, $single_price_active, $active, $created, $changed): ObjectsGroupsB2b
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->group_id = $group_id;
            $this->b2b_id = $b2b_id;
            $this->value = $value;
            $this->tolken = $tolken;
            $this->web = $web;
            $this->price_id = $price_id;
            $this->username = $username;
            $this->password = $password;
            $this->price_type = $price_type;
            $this->percent = $percent;
            $this->price1_percent = $price1_percent;
            $this->people_max = $people_max;
            $this->single_price_active = $single_price_active;
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
            'group_id' => Yii::t('app', 'Group ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'value' => Yii::t('app', 'Value'),
            'tolken' => Yii::t('app', 'Tolken'),
            'web' => Yii::t('app', 'Web'),
            'price_id' => Yii::t('app', 'Price ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'price_type' => Yii::t('app', 'Price Type'),
            'percent' => Yii::t('app', 'Percent'),
            'price1_percent' => Yii::t('app', 'Price1 Percent'),
            'people_max' => Yii::t('app', 'People Max'),
            'single_price_active' => Yii::t('app', 'Single Price Active'),
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
    public function getGroup()
    {
        return $this->hasOne(ObjectsGroups::class, ['id' => 'group_id']);
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
     * @return \reception\entities\MyRent\queries\ObjectsGroupsB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ObjectsGroupsB2bQuery(get_called_class());
    }
}
