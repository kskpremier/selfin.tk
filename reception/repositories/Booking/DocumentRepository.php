<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\dispatchers\EventDispatcher;
use reception\entities\Booking\Document;
use reception\entities\Face;
use reception\entities\Image\AbstractImage;
use reception\repositories\NotFoundException;
use yii\db\Query;

class DocumentRepository
{   private $dispatcher;

    public function __construct(EventDispatcher $dispatcher) {
    $this->dispatcher = $dispatcher;
    }

    public function get($id): Document
    {
        if (!$document = Document::findOne($id)) {
            throw new NotFoundException('Document is not found.');
        }
        return $document;
    }
    public function getByDocumentNumber($documentNumber): Document
    {
        if (!$document = Document::find()->where(["number"=>$documentNumber])->one()) {
            return false;//throw new NotFoundException('Document is not found.');
        }
        return $document;
    }

    public function getForGuests($iDs): array
    {
        $documents=[];
        $documents = Document::find()->where(["guest_id"=>$iDs])->all();
        return $documents;
    }
    public function isDocumentExist($firstName, $secondName, $numberOfDocument, $country, $dateOfBirth, $city)
    {
        if ($document = Document::findOne(['first_name' => $firstName,'second_name'=>$secondName,'number'=>$numberOfDocument,'date_of_birth'=>$dateOfBirth, 'city'=>$city])) {
            return $document;
        }
        return false;
    }

    public function save(Document $document): void
    {
        if (!$document->save()) {
            throw new \RuntimeException('Saving error.');
        }
        $this->dispatcher->dispatchAll($document->releaseEvents());
    }

    public function remove(Document $document): void
    {
        if (!$document->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        $this->dispatcher->dispatchAll($document->releaseEvents());
    }

    public function removeById(int $id): void
    {
        $document = $this->get ($id);
        if ($document) {
            if (!$document->delete()) {
                throw new \RuntimeException('Removing error.');
            }
        }
    }

    public function isDocumentReadyForMatching(Document $document):array
    {
        //убедиться, что документ имеет распознанные фото с лицом
        $docPhotos = Face::find()->where([
            "image_id" => (new \yii\db\Query())->select("I.id")->from(["I"=>"image"])->leftJoin(["D"=>"document"],'I.document_id=D.id')
                ->where(["D.id"=>$document->id])->andWhere(["I.album_id"=>AbstractImage::ALBUM_DOCUMENT])->column()
            ])->all();
        //убедиться, что документ имеет распознанные фото с селфи
        $facePhotos = Face::find()->where([
            "image_id" => (new \yii\db\Query())->select("I.id")->from(["I"=>"image"])->leftJoin(["D"=>"document"],'I.document_id=D.id')
                ->where(["D.id"=>$document->id])->andWhere(["I.album_id"=>AbstractImage::ALBUM_FACES])->column()
        ])->all();
        $ArrayForCompearing["doc"] = $docPhotos;
        $ArrayForCompearing["face"] = $facePhotos;
        return $ArrayForCompearing;
    }
}