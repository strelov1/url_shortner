<?php

namespace app\behaviors;

use yii\db\ActiveRecord;

class ExpiredBehavior extends \yii\base\Behavior
{
    public $expiredAtAttribute = 'expired_at';

    public $value;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
        ];
    }

    public function beforeSave()
    {
        $time = time() + 3600 * 24 * (int)\Yii::$app->params['expired_days'];
        $this->owner->{$this->expiredAtAttribute} = $time;
    }
}
