<?php

namespace reception\entities\Booking\events;

use reception\entities\Booking\Document;
use reception\forms\PhotosForm;
use reception\forms\SelfyForm;

class DocumentAddRequested
{
    public $document;
    public $photos;
    public $selfy;

    public function __construct(Document $document, PhotosForm $photos=null, SelfyForm $selfy=null)
    {
        $this->document = $document;
        $this->photos = $photos;
        $this->selfy = $selfy;
    }
}