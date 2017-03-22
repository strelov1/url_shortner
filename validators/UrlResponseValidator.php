<?php

namespace app\validators;

use app\forms\UrlForm;
use yii\httpclient\Client;
use yii\validators\Validator;

class UrlResponseValidator extends Validator
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
     * Check HTTP-response
     *
     * @param $url
     * @return bool
     */
    private function checkResponse($url)
    {
        try {
            $client = new Client();
            $client->setTransport(\yii\httpclient\CurlTransport::class);
            $response = $client->get($url)->setOptions([
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_NOBODY => true,
            ])->send();

            if ($response->isOk) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
