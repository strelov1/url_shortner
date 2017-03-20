<?php

namespace app\validators;

use app\forms\UrlForm;
use yii\httpclient\Client;
use yii\validators\Validator;

class UrlValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        /** @var UrlForm $url */
        $url = $model->$attribute;

        if ($url === null) {
            $model->addError($attribute,'Url is null');
            return false;
        }

        if (!$this->checkResponse($url)) {
            $model->addError($attribute,'Url not response');
            return false;
        }
    }

    /**
     * @param $url
     * @return bool
     */
    private function checkResponse($url)
    {
        try {
            $client = new Client();
            $response = $client->get($url)->send();

            if ($response->isOk) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
