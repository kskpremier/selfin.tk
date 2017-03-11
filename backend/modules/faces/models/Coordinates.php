<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.03.17
 * Time: 14:48
 */

namespace backend\modules\faces\models;


class Coordinates
{
    private $x; //357.32843017578,
    private $y; //427.38688659668,
    private $width; // 141.84358409738,
    private $angle;// 0.041555393690548

    /**
     * Coordinates constructor.
     * @param $json string with parameters
     */
    public function __construct($json)
    {
        $data = json_decode($json);
        $this->x = $data['x'];
        $this->y = $data['y'];
        $this->width = $data['width'];
        $this->angle = $data['angle'];
    }

}