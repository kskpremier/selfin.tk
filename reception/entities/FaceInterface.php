<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/4/17
 * Time: 10:01 PM
 */


namespace reception\entities;


/**
 * This is the model interface for table "face".

 */
Interface FaceInterface
{

    public static function create($face_id, $file_name, $x, $y, $width, $angle, $document = null, $parentImage = null);

    public function edit(FaceInterface $face, $face_id,$file_name,$x,$y,$width, $angle, $image=null, $document=null);

    public function remove($face_id);


}
