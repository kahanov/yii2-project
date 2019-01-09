<?php

namespace core\helpers;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use core\entities\user\User;

/**
 * User helper class
 */
class UserHelper
{
    /**
     * Drop-down list of user statuses
     * @return array
     */
    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * The formation of status
     * @param $status
     * @return string
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * Formation of the list
     * @param $status
     * @return string
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case User::STATUS_WAIT:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}
