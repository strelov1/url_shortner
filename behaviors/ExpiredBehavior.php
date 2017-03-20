<?php

namespace app\behaviors;

use yii\base\InvalidValueException;
use yii\db\ActiveRecord;

class ExpiredBehavior extends \yii\base\Behavior
{
    public $expiredAtAttribute = 'expired_at';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    /**
     * Install expired day to Url model
     */
    public function beforeInsert()
    {
        $expired_days = \Yii::$app->params['expired_days'];
        if (!$expired_days) {
            throw new InvalidValueException('Not install expired_days in params');
        }
        $time = time() + 3600 * 24 * (int)$expired_days;
        $this->owner->{$this->expiredAtAttribute} = $time;
    }
}
