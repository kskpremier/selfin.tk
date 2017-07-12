<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 08.06.17
 * Time: 10:24
 */
namespace backend\helpers;

use backend\models\Face;
use backend\models\FaceComparation;

class FaceComparationHelper {
    public static function GetFacesForMatching(Face $originFace){

        //по имеющейся фото Лица определяем список Лиц, с которыми следовало бы провести сравнение
        //Лицо извлечено из какого-либо Изображения, которое получено и привязано к каому-либо Букингу, соответственно
        // было бы логично предложить пользователю ограниченный список Лиц для сравнения так или иначе связанных с данным
        // Букингом
        $facesList = []; //массив для лиц
        //первое - определить к какому Букингу принадлежит Лицо Лицо->Изображение->Букинг
//        $originFace = (Face::findOne($faceId);
        $originPhotoImage = $originFace->photoImage;
        $booking = $originPhotoImage->getBooking()->one();
        //второе - получить список Изображений, принадлежащих Букингу
        $listOfPhotoImageFromBooking = $booking->getPhotoImages()->all();
        //третье - получить список Лиц в каждом Изображении
        foreach ($listOfPhotoImageFromBooking as $photoImage){
            $listOfFace = $photoImage->getFaces()->all();
            foreach ($listOfFace as $face){
               // if (!FaceComparation::isMatched($face, $originFace)){
                    $facesList[] =  $face;
              //  }
            }
        }
        return $facesList;
    }
}