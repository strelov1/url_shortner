<?php

namespace app\behaviors;

use app\models\UrlCounter;
use yii\db\ActiveRecord;

/**
 * Counter added url from ShorterWithCounter insted COUNT()
 * Class CounterBehavior
 * @package app\behaviors
 */
class CounterBehavior extends \yii\base\Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ];
    }

    /**
     * Update counter
     */
    public function afterInsert()
    {
        UrlCounter::updateAllCounters(['value' => 1], ['id' => UrlCounter::URL_COUNTER]);
    }
}
