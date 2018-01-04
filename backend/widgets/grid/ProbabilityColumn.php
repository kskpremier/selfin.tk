<?php

namespace backend\widgets\grid;

use reception\entities\Booking\Facecomparation;
use reception\entities\Booking\Booking;
use Yii;
use yii\grid\DataColumn;
use yii\helpers\Html;


class ProbabilityColumn extends DataColumn
{
    protected function renderDataCellContent($model, $key, $index): string
    {
        $probability = $model->probability;
        return $probability === [] ? $this->grid->emptyCell : $this->getRoleLabel($model);

//        $roles = Yii::$app->authManager->getRolesByUser($model->id);
//        return $roles === [] ? $this->grid->emptyCell : implode(', ', array_map(function (Item $role) {
//            return $this->getRoleLabel($role);
//        }, $roles));
    }

    private function getRoleLabel($faceComparation): string
    {
        $class = ( $faceComparation->probability  >= Booking::BOOKING_RECOCNITION_LOWREST_PROBABILITY) ? 'primary' : 'danger';
        return Html::tag('span', Html::encode($faceComparation->probability), ['class' => 'label label-' . $class]);
    }
}