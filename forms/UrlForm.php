<?php

namespace app\forms;

use app\models\Url;
use app\validators\UrlValidator;

class UrlForm extends \yii\base\Model
{
    public $long_url;
    public $desired_short_url;
    public $short_url;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['long_url', 'required'],
            ['long_url', 'url'],
            ['long_url', UrlValidator::className()],
            //['long_url', 'exist', 'targetClass' => Url::className()]
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $url = new Url();
        $url->long_url = $this->long_url;
        $url->short_url = $this->shortUrl();
        $this->short_url = \yii\helpers\Url::to($url->short_url, true);
        return $url->save();
    }


    public function shortUrl()
    {
        return \Yii::$app->shorter->create();
    }
}
