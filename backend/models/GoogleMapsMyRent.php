<?php

namespace backend\models;

use function key_exists;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii2mod\google\maps\markers\GoogleMaps;

/**
 * GoogleMaps displays a set of user addresses as markers on the map.
 *
 * To use GoogleMaps, you need to configure its [[userLocations]] property. For example:
 *
 * ```php
 * echo yii2mod\google\maps\markers\GoogleMaps::widget([
 *     'userLocations' => [
 *           [
 *               'location' => [
 *                   'address' => 'Kharkov',
 *                   'country' => 'Ukraine',
 *               ],
 *               'htmlContent' => '<h1>Kharkov</h1>'
 *           ],
 *           [
 *               'location' => [
 *                   'city' => 'New York',
 *                   'country' => 'Usa',
 *               ],
 *               'htmlContent' => '<h1>New York</h1>'
 *           ],
 *     ]
 * ]);
 * ```
 */
class GoogleMapsMyRent extends GoogleMaps
{
    public function init()
    {
        parent::init();
    }


    /**
     * Get place urls and htmlContent
     *
     * @return string
     */
    protected function getGeoCodeData()
    {
        $result = [];
        foreach ($this->userLocations as $data) {
            if (key_exists('latitude',$data['location']))
                $result[] = [
                    'latitude' => ArrayHelper::getValue($data['location'], 'latitude'),
                    'longitude' =>  ArrayHelper::getValue($data['location'], 'longitude'),
                    'htmlContent' => ArrayHelper::getValue($data, 'htmlContent'),
                ];
            else
            $result[] = [
                'country' => ArrayHelper::getValue($data['location'], 'country'),
                'address' => implode(',', ArrayHelper::getValue($data, 'location')),
                'postalCode'=> ArrayHelper::getValue($data['location'], 'postalCode'),
                'city'=> ArrayHelper::getValue($data['location'], 'city'),
                'htmlContent' => ArrayHelper::getValue($data, 'htmlContent'),
            ];
        }

        return $result;
    }

}
