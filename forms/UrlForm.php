<?php

namespace app\forms;

use app\models\Url;
use app\validators\UrlResponseValidator;

class UrlForm extends \yii\base\Model
{
    public $long_url;
    public $short_url;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['long_url', 'required'],
            ['long_url', 'url'],
            ['short_url', 'filter', 'filter' => [$this, 'urlFilter']],
            ['long_url', UrlResponseValidator::className()],
            ['long_url', 'unique', 'targetClass' => Url::className()],
            ['short_url', 'unique', 'targetClass' => Url::className()]
        ];
    }

    public function urlFilter($value)
    {
        $path = parse_url($value, PHP_URL_PATH);
        return str_replace('/', '', $path);
    }

    /**
     * Save for storage
     * @return bool
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $url = new Url();
        $url->long_url = $this->long_url;
        $url->short_url = $this->short_url;

        if (!$url->save()) {
            $this->addError('long_url', 'Save Error');
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function initShortUrl()
    {
        $this->short_url = \Yii::$app->shorter->create();
    }
}
