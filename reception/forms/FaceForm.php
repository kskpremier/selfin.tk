<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/4/17
 * Time: 10:19 PM
 */


namespace reception\forms;

use reception\entities\Booking\DocumentPhoto;
use reception\entities\Booking\Photo;
use yii\base\Model;

/**
 * @property LockVersionForm $lockVersion
 */
class FaceForm extends Model
{
    public $face_id;
    public $x;
    public $y;
    public $width;
    public $angle;
    public $photo_image_id;
    public $photo_document_id;
    public $image;



    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['x', 'y', 'width', 'angle'], 'number'],
            [['photo_image_id','isChecked'], 'integer'],
            [['face_id'], 'string', 'max' => 255],
            [['photo_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['photo_image_id' => 'id']],
            [['photo_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentPhoto::className(), 'targetAttribute' => ['photo_document_id' => 'id']],
            [['photo_image_id','photo_document_id'],'validateImage','message'=>'Wrong id of photo_document_id or photo_image_id'],
        ];
    }

// проверяем есть ли документ фото или реальное фото с заданным id и присваивает его в $image
    public function validateImage(){
        if (!isset($this->photo_image_id) && !isset($this->photo_document_id)){
            $this->addError('One of image source should be set (document or photo');
            return false;
        }
        if ($this->photo_image_id){
            $photo = Photo::find()->where(['id'=>$this->photo_image_id])->one();
        }
        elseif ($this->photo_document_id) {
            $photo = DocumentPhoto::find()->where(['id'=>$this->photo_document_id])->one();
        }
        if (!isset($photo)){
            $this->addError('Wrong id of source for face entity');
        }
        $this->image = $photo;
        return true;
    }

}