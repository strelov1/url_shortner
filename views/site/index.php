<?php

/* @var $this yii\web\View */
/* @var $urlForm \app\forms\UrlForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="body-content">

        <?php $form = ActiveForm::begin(['id' => 'url-form']); ?>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($urlForm, 'long_url')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($urlForm, 'short_url')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <?= Html::submitButton('Get Short Url', [
                        'class' => 'btn btn-primary',
                    ]) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>