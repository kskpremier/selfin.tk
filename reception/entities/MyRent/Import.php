<?php


namespace reception\entities\MyRent;

use Yii;

/**
 * This is the model class for table "_import".
 *
 * @property int $id
 * @property string $col1
 * @property string $col2
 * @property string $col3
 * @property string $col4
 * @property string $col5
 * @property string $col6
 * @property string $col7
 * @property string $col8
 * @property string $col9
 * @property string $col10
 * @property string $col11
 * @property string $col12
 * @property string $col13
 * @property string $col14
 * @property string $col15
 * @property string $col16
 * @property string $col17
 * @property string $col18
 * @property string $col19
 * @property string $col20
 * @property string $col21
 * @property string $col22
 * @property string $col23
 * @property string $col24
 * @property string $col25
 * @property string $created
 */
class Import extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_import';
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
        * @param string $col1//
        * @param string $col2//
        * @param string $col3//
        * @param string $col4//
        * @param string $col5//
        * @param string $col6//
        * @param string $col7//
        * @param string $col8//
        * @param string $col9//
        * @param string $col10//
        * @param string $col11//
        * @param string $col12//
        * @param string $col13//
        * @param string $col14//
        * @param string $col15//
        * @param string $col16//
        * @param string $col17//
        * @param string $col18//
        * @param string $col19//
        * @param string $col20//
        * @param string $col21//
        * @param string $col22//
        * @param string $col23//
        * @param string $col24//
        * @param string $col25//
        * @param string $created//
        * @return Import    */
    public static function create($id, $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19, $col20, $col21, $col22, $col23, $col24, $col25, $created): Import
    {
        $import = new static();
                $import->id = $id;
                $import->col1 = $col1;
                $import->col2 = $col2;
                $import->col3 = $col3;
                $import->col4 = $col4;
                $import->col5 = $col5;
                $import->col6 = $col6;
                $import->col7 = $col7;
                $import->col8 = $col8;
                $import->col9 = $col9;
                $import->col10 = $col10;
                $import->col11 = $col11;
                $import->col12 = $col12;
                $import->col13 = $col13;
                $import->col14 = $col14;
                $import->col15 = $col15;
                $import->col16 = $col16;
                $import->col17 = $col17;
                $import->col18 = $col18;
                $import->col19 = $col19;
                $import->col20 = $col20;
                $import->col21 = $col21;
                $import->col22 = $col22;
                $import->col23 = $col23;
                $import->col24 = $col24;
                $import->col25 = $col25;
                $import->created = $created;
        
        return $import;
    }

    /**
            * @param int $id//
            * @param string $col1//
            * @param string $col2//
            * @param string $col3//
            * @param string $col4//
            * @param string $col5//
            * @param string $col6//
            * @param string $col7//
            * @param string $col8//
            * @param string $col9//
            * @param string $col10//
            * @param string $col11//
            * @param string $col12//
            * @param string $col13//
            * @param string $col14//
            * @param string $col15//
            * @param string $col16//
            * @param string $col17//
            * @param string $col18//
            * @param string $col19//
            * @param string $col20//
            * @param string $col21//
            * @param string $col22//
            * @param string $col23//
            * @param string $col24//
            * @param string $col25//
            * @param string $created//
        * @return Import    */
    public function edit($id, $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19, $col20, $col21, $col22, $col23, $col24, $col25, $created): Import
    {

            $this->id = $id;
            $this->col1 = $col1;
            $this->col2 = $col2;
            $this->col3 = $col3;
            $this->col4 = $col4;
            $this->col5 = $col5;
            $this->col6 = $col6;
            $this->col7 = $col7;
            $this->col8 = $col8;
            $this->col9 = $col9;
            $this->col10 = $col10;
            $this->col11 = $col11;
            $this->col12 = $col12;
            $this->col13 = $col13;
            $this->col14 = $col14;
            $this->col15 = $col15;
            $this->col16 = $col16;
            $this->col17 = $col17;
            $this->col18 = $col18;
            $this->col19 = $col19;
            $this->col20 = $col20;
            $this->col21 = $col21;
            $this->col22 = $col22;
            $this->col23 = $col23;
            $this->col24 = $col24;
            $this->col25 = $col25;
            $this->created = $created;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'col1' => Yii::t('app', 'Col1'),
            'col2' => Yii::t('app', 'Col2'),
            'col3' => Yii::t('app', 'Col3'),
            'col4' => Yii::t('app', 'Col4'),
            'col5' => Yii::t('app', 'Col5'),
            'col6' => Yii::t('app', 'Col6'),
            'col7' => Yii::t('app', 'Col7'),
            'col8' => Yii::t('app', 'Col8'),
            'col9' => Yii::t('app', 'Col9'),
            'col10' => Yii::t('app', 'Col10'),
            'col11' => Yii::t('app', 'Col11'),
            'col12' => Yii::t('app', 'Col12'),
            'col13' => Yii::t('app', 'Col13'),
            'col14' => Yii::t('app', 'Col14'),
            'col15' => Yii::t('app', 'Col15'),
            'col16' => Yii::t('app', 'Col16'),
            'col17' => Yii::t('app', 'Col17'),
            'col18' => Yii::t('app', 'Col18'),
            'col19' => Yii::t('app', 'Col19'),
            'col20' => Yii::t('app', 'Col20'),
            'col21' => Yii::t('app', 'Col21'),
            'col22' => Yii::t('app', 'Col22'),
            'col23' => Yii::t('app', 'Col23'),
            'col24' => Yii::t('app', 'Col24'),
            'col25' => Yii::t('app', 'Col25'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\ImportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\ImportQuery(get_called_class());
    }
}
