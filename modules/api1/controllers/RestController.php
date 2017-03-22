<?php

namespace app\modules\api1\controllers;

use app\models\Url;
use app\forms\UrlForm;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

/**
 * Default controller for the `api1` module
 */
class RestController extends Controller
{
    /**
     * @param $long_url
     * @param $short_url
     * @param $save
     * @return UrlForm
     */
    public function actionCreate($long_url, $short_url = null, $save = null)
    {
        $urlForm = new UrlForm();
        $urlForm->long_url = $long_url;

        if (!$short_url) {
            $urlForm->initShortUrl();
        } else {
            $urlForm->short_url = $short_url;
        }

        $urlForm->validate();

        if ($save) {
            $urlForm->save();
        }
        return $urlForm;
    }

    public function actionStats()
    {
        return new ActiveDataProvider([
            'query' => Url::find(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
    }
}
