<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\entities\Booking\Document;
use reception\repositories\NotFoundException;

class DocumentRepository
{
    public function get($id): Document
    {
        if (!$document = Document::findOne($id)) {
            throw new NotFoundException('Document is not found.');
        }
        return $document;
    }
    public function isDocumentExist($firstName, $secondName,$numberOfDocument, $country, $dateOfBirth)
    {
        if ($document = Document::findOne(['first_name' => $firstName,'second_name'=>$secondName,'number'=>$numberOfDocument,'country_id'=>$country,'date_of_birth'=>$dateOfBirth])) {
            return $document;
        }
        return false;
    }

    public function save(Document $document): void
    {
        if (!$document->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Document $document): void
    {
        if (!$document->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}