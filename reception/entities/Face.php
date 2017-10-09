<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/5/17
 * Time: 10:16 AM
 */

namespace reception\entities;

use backend\service\FACEMATIKA;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\Booking\FaceComparation;
use reception\entities\Booking\Photo;
use reception\entities\FaceInterface;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * @property string $face_id;
 * @property string $file_name;
 * @property double $x;
 * @property double $y;
 * @property double $width;
 * @property double $angle;
 * @property integer $id;
 * @property integer $photo_image_id;
 * @property integer $photo_document_id;
 * @property ActiveQuery $faceComparations
 * @property ActiveQuery $photoImage
 * @property ActiveQuery $documentImage
 *
 * @mixin SaveRelationsBehavior
 * @mixin ImageUploadBehavior
*/

class Face extends ActiveRecord implements FaceInterface
{
//    public $face_id;
//    public $x;
//    public $y;
//    public $width;
//    public $angle;
//    public $id;
    
    /**
     * @inheritdoc
     */

    public static function create($face_id,$file_name, $x,$y,$width,$angle, $photoImageId=null, $documentPhotoId=null): self
    {
        $face = new static();
        $face->face_id = $face_id;
        $face->x = $x;
        $face->y = $y;
        $face->width = $width;
        $face->angle = $angle;
        $face->file_name = $file_name;
        $face->photo_image_id = $photoImageId;
        $face->photo_document_id = $documentPhotoId;
        return $face;

    }
    public function edit(FaceInterface $face, $face_id,$file_name,$x,$y,$width, $angle,  $photoImageId=null, $documentPhotoId=null): self
    {
        $face->face_id = $face_id;
        $face->x = $x;
        $face->y = $y;
        $face->width = $width;
        $face->angle = $angle;
        $face->photo_image_id = $photoImageId;
        $face->photo_document_id = $documentPhotoId;
        return $face;
    }
    /**
     * Compare $this face with list of $faces
     * Make FaceComparations instance
     * returm face with max value of probability
     * @param Face [] $faces
    */
    public function faceMatch(array $faces)
    {
        $comparations=[];
        $probability = 0;
        $faceMatchedId = null;

        $post='[';
        foreach ($faces as $face) {
            if ($this->isNotYetCompared($face)) {
                $face_string = '{"faceid":"'.$face->face_id.'"}';
                $post.=$face_string;
                $post.=',';
            }
        }
        $post = substr($post, 0, -1);
        $post.=']';
        $respond = FACEMATIKA::faceCompare($post,$this->face_id);
        $data = json_decode($respond->content, true);
        if (is_array($data['result'])) {
            foreach ($data['result'] as $id => $result) {
                $faceComparation = FaceComparation::create($this->id, key($result), $result[key($result)]);
                //$repository->save($faceComparation);
                $comparations[] = $faceComparation;
                if (($this->id != key($result)) && $probability < $result[key($result)]) {
                    $probability = $result[key($result)];
                    $faceMatchedId = key($result);
                }
            }
        } else  throw new ServerErrorHttpException('Wrong result of face comparation =>' . $respond);
        $this->faceComparations = $comparations;
//        $this->save();
        return ($faceMatchedId)? $faces[array_search ($faceMatchedId, $faces)] : null;
    }
/**
 * Return the most similar face to this one or null
*/

    public function  getTheMostSimilarFace() {
        $comparation = FaceComparation::find()->where(['origin_id'=>$this->id])->andWhere(['<>',['face_id'=>$this->face_id]])->sortBy('probability')->limit(1);
        if ($comparation){
            return $comparation->face;
        }
        return null;
    }

    public function  getTheMostSimilarFaceComparationProbability() {
        $comparation = FaceComparation::find()->where(['origin_id'=>$this->id])->andWhere(['<>',['face_id'=>$this->face_id]])->sortBy('probability')->limit(1);
        if ($comparation){
            return $comparation->probability;
        }
        return null;
    }

    public static function tableName()
    {
        return '{{%face}}';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaceComparations()
    {
        return $this->hasMany(FaceComparation::className(), ['origin_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImage()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_image_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentImage()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_document_id']);
    }

    public function behaviors(): array
    {
        return [
            //   MetaBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['faceComparations'],
            ],
            [   'class' => ImageUploadBehavior::className(),
                'attribute' => 'file_name',
                'createThumbsOnRequest' => true,
                'filePath' => '@facePath/[[attribute_file_name]]',
                'fileUrl' => '@faceUrl/[[attribute_file_name]]',
                'thumbPath' => '@facePath/cache/[[attribute_file_name]]',
                'thumbUrl' => '@faceUrl/cache/[[attribute_file_name]]',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 25],
                ],

            ]
        ];
    }

    public function isNotYetCompared(Face $face)
    {
        return FaceComparation::isMatched($this,$face);
    }


    public function getImagePath(){
        return Yii::getAlias('@facePath') . '/' ;
    }
    public function getImageNameWithPath(){
        return Yii::getAlias('@facePath') . '/' . $this->file_name;
    }
    public function getImageUrl(){
        return Yii::getAlias('@faceUrl') . '/' . $this->file_name;
    }
}