<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/8/17
 * Time: 2:14 PM
 */
namespace reception\entities\Booking\queries;

use reception\entities\Booking\Booking;
use reception\entities\Image\AbstractImage;
use yii\db\ActiveQuery;

class DocumentQuery extends ActiveQuery
{
    public function asPhoto()
    {
        return $this->joinWith(["images Im"],true, 'INNER JOIN')->andWhere(['Im.album_id' => AbstractImage::ALBUM_FACES]);
    }
    public function asDocumentPhoto()
    {
        return $this->joinWith(["images Im"])->andWhere(['album_id' => AbstractImage::ALBUM_DOCUMENTS]);
    }
    /**
     * @param null $db
     * @return array|User[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    /**
     * @param null $db
     * @return array|null|User
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}