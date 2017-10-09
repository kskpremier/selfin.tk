<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 8:25
 */

namespace reception\repositories\Booking;

use reception\entities\Face;
use reception\repositories\NotFoundException;

class FaceRepository
{
    public function get($id): Face
    {
        if (!$face = Face::findOne($id)) {
            throw new NotFoundException('Face is not found.');
        }
        return $face;
    }
    public function getByFaceId($face_id): Face
    {
        if (!$face = Face::findOne(['face_id'=>$face_id])) {
            throw new NotFoundException('Face is not found.');
        }
        return $face;
    }

    public function save(Face $face): void
    {
        if (!$face->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Face $face): void
    {
        if (!$face->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}