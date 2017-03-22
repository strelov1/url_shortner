<?php

namespace app\modules\api1\controllers;

use app\models\Url;
use app\forms\UrlForm;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `api1` module
 */
class RestController extends \yii\rest\Controller
{
    /**
     * @return UrlForm
     */
    public function actionCreate()
    {
        $post = \Yii::$app->request;

        $long_url = $post->post('long_url');
        $short_url = $post->post('short_url');
        $save = $post->post('save');

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
