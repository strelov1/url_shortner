<?php

namespace app\forms;

use app\validators\UrlValidator;
use yii\base\Model;

class UrlForm extends Model
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
    }
}
