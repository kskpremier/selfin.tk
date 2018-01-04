<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 12/17/17
 * Time: 10:32 PM
 */


namespace reception\entities\Booking\events;

use reception\entities\Booking\Document;
use reception\forms\PhotosForm;
use reception\forms\SelfyForm;

class FaceDetected
{
    public $facesFromDocument;
    public $facesFromCamera;
    public $document;


    public function __construct(Document $document, Face $face, $which)
    {
        $this->document = $document;
        if($which =="document"){
            $this->facesFromDocument[] = $face;
        }
        else $this->facesFromCamera[] = $face;
    }
}