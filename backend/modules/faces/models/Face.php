<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.03.17
 * Time: 14:44
 */

namespace backend\modules\faces\models;

use backend\modules\faces\Coordinates;

class Face
{

    private $faceid; // "face-dea3y0wsw3cwcwc8k",
    private $coordinates;

    /**
     * Face constructor.
     * @param $json string with parameters
     */
    public function __construct($json)
    {
        $data = json_decode($json);
        $this->faceid = $data['faceid'];
        $this->coordinates = new Coordinates($data['coordinates']);
    }
}