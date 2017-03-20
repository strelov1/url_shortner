<?php

namespace app\controllers;

use Yii;
use app\models\Url;
use app\forms\UrlForm;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

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
     *
     * @return string
     */
    public function actionIndex()
    {
        $urlForm = new UrlForm();
        $request = Yii::$app->request;

        if ($urlForm->load($request->post()) && $urlForm->save()) {
            Yii::$app->session->setFlash('success', 'Success');
        }

        return $this->render('index', [
            'urlForm' => $urlForm
        ]);
    }

    /**
     * @param $url
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionMatch($url)
    {
        $matchUrl = Url::find()
            ->matchUrl($url)
            ->notExpired()
            ->one();

        if ($matchUrl) {
            $this->redirect($matchUrl->long_url)->send();
            return true;
        }
        throw new NotFoundHttpException('Not found short url');
    }

}
