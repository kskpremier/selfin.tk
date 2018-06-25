<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 5/21/18
 * Time: 8:53 PM
 */

namespace reception\forms\MyRent;

use yii\base\Model;

class RoomsFacilitiesForm extends Model
{
    public $numberOfRooms;
    public $space;
    public $spaceYard;
    public $floor;
    public $beds;
    public $kingSizeBed;
    public $can_sleep_max;
    public $can_sleep_optimal;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kingSizeBed'], 'in','range'=>['Y','N']],
            [['numberOfRooms','space', 'spaceYard', 'floor', 'beds','can_sleep_max', 'can_sleep_optimal',],'integer']

        ];
    }
}