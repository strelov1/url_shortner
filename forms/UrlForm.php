<?php

namespace app\forms;

use app\models\Url;
use app\validators\UrlValidator;

class UrlForm extends \yii\base\Model
{
    public $long_url;
    public $desired_short_url;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['long_url', 'required'],
            ['long_url', 'url'],
            ['long_url', UrlValidator::className()],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $url = new Url();
        $url->long_url = $this->long_url;
        $url->short_url = $this->long_url;
        return $url->save();
    }
}
