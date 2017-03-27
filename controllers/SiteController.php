<?php

namespace app\controllers;

use Yii;
use app\models\Url;
use app\forms\UrlForm;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\base\InvalidParamException;

class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'match' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     * @throws InvalidParamException
     * @return string
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $urlForm = new UrlForm();

        $urlForm->initShortUrl();

        // Save result
        if ($urlForm->load($request->post()) && $urlForm->validate()) {
            $urlForm->save();
        }

        $urlForm->short_url = \yii\helpers\Url::to($urlForm->short_url, true);

        return $this->render('index', [
            'urlForm' => $urlForm
        ]);
    }

    /**
     * Short url catcher
     * @param $url
     * @return bool
     * @throws NotFoundHttpException | StaleObjectException
     */
    public function actionMatch($url)
    {
        $matchUrl = Url::find()
            ->matchUrl($url)
            ->one();

        if ($matchUrl === null) {
            Yii::error("Not found short url {$url}", 'shorter');
            throw new NotFoundHttpException('Not found short url');
        }

        if ($matchUrl->isExpired()) {
            Yii::error("Expire short url {$url}", 'shorter');
            $matchUrl->delete();
            Yii::error("Delete expire short url {$url}", 'shorter');
            throw new NotFoundHttpException('Short url is expired');
        }

        if ($matchUrl) {
            $matchUrl->counted();
            Yii::info("Redirect short url {$url}", 'shorter');
            $this->redirect($matchUrl->long_url, 301)->send();
            return true;
        }
    }


    public function actionStats()
    {

        $provider = new ActiveDataProvider([
            'query' => Url::find(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('stats', [
            'dataProvider' => $provider
        ]);
    }

}
