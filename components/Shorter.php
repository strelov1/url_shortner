<?php

namespace app\components;

use app\models\UrlCounter;

class Shorter extends \yii\base\Component
{
    public $beginBit;
    public $chars;

    public function create()
    {
        $bit = UrlCounter::getCount();
        if (!$bit) {
            $bit = $this->beginBit;
        }
        return $this->generate($bit);
    }

    /**
     * @param $bit
     * @return string
     */
    public function generate($bit)
    {
        $hash = [];
        $length = strlen($this->chars);

        while ($bit > 0) {
            $index = $bit % $length;
            $hash[] = !empty($this->chars{$index}) ? $this->chars{$index} : 0;
            $bit = floor($bit / $length);
        }

        return implode('', $hash);
    }
}
