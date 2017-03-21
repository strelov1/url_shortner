<?php

namespace app\components;

class ShorterRand extends \yii\base\Component implements ShorterInterface
{
    public $length = 3;

    public function create()
    {
        return $this->generate($this->length);
    }

    /**
     * @param $length
     * @return string
     */
    public function generate($length)
    {
        return \Yii::$app->security->generateRandomString($length);
    }
}
