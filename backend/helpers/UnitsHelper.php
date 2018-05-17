<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 5/14/18
 * Time: 5:20 PM
 */
namespace backend\helpers;

class UnitsHelper
{
    public static function getAdresses($query, $pages)
    {
        $models = $query->offset($pages->offset)->all();
        $locations = [];
        foreach ($models as $model) {
//            if ($model->unit->latitude && $model->unit->longitude)
//                $locations[] =  ['location'=>[
//                                                                    'latitude' => $model->unit->latitude,
//                                                                    'longitude' => $model->unit->longitude
//                                                                     ],
//                                                         'htmlContent' => '<span class="glyphicon glyphicon-map-marker"id="geo-'.$model->id.'">'.$model->id.'</span>'
//                                                     ];
//            else $locations[] = ['location' => ['address' => ($model->unit->adress)?$model->unit->adress:'',
//                'postalCode' => ($model->unit->city_zip)?$model->unit->city_zip:'',
//                'city' => ($model->unit->city_name)?$model->unit->city_name:'',
//                'country' => ($model->unit->country)?$model->unit->country->country:'Croatia',
//            ],
//                'htmlContent' => '<span class="glyphicon glyphicon-map-marker" id="geo-'.$model->id.'">'.$model->id.'</span>'
//            ];
            $locations[] = ['location' => ['address' => ($model->unit->adress)?$model->unit->adress:'',
                'postalCode' => ($model->unit->city_zip)?$model->unit->city_zip:'',
                'city' => ($model->unit->city_name)?$model->unit->city_name:'',
                'country' => ($model->unit->country)?$model->unit->country->country:'Croatia',
            ],
                'htmlContent' => "<span class='glyphicon glyphicon-map-marker' id='geo-".$model->id."'>".$model->id."</span>"
            ];
        }
        return $locations;
    }
}