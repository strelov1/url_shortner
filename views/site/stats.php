<?php

/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'long_url:url',
        [
            'attribute' => 'short_url',
            'format' => 'raw',
            'value' => function($dataProvider) {
                $url = \yii\helpers\Url::to($dataProvider->short_url, 'http');
                return \yii\helpers\Html::a($url, $url);
            },
        ],
        'expired_at:datetime',
        'counter',
    ],
]) ?>