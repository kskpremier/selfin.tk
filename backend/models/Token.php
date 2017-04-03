<?php

namespace backend\models;

use Codeception\Lib\Interfaces\ActiveRecord;
use Yii;

/**
 * This is the model class for table "token".
 *
 * @property integer $id
 * @property string $token
 * @property string $expires
 * @property string $type
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'type','expires'], 'required'],
            [['expires'], 'safe'],
            [['token', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'token',
            'expires' => 'expire',
            'type' => 'type',
        ];
    }
    /**
     * Renders the first existing and valid token AR or return false
     * @return ActiveRecord or boolean
     */
    public function findValidToken() {
        $properToken = $this->find()->where(['>','expires', strtotime(date('Y-m-d\TH:i:s\+P'))])->one();
        if ($properToken)
            return $properToken;
        return false;
    }
}
