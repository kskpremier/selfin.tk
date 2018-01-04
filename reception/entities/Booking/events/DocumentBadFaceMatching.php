<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 12/14/17
 * Time: 2:33 PM
 */

namespace reception\entities\Booking\events;


use reception\entities\Booking\Document;

class DocumentBadFaceMatching
{
    public $document;
    public $maxProbability;

    public function __construct(Document $document, $maxProbability)
    {
        $this->document = $document;
        $this->maxProbability = $maxProbability;
    }
}