<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 4/29/18
 * Time: 12:23 PM
 */

interface EntityUpdateInterface {
    public function getListForUpdate($id);
    public function update($list, $repository);
}