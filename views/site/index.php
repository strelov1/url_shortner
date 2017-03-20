<?php

/* @var $this yii\web\View */
/* @var $urlForm \app\forms\UrlForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <?php $form = ActiveForm::begin(['id' => 'url-form']); ?>

            <div class="col-lg-6">
                <?= $form->field($urlForm, 'long_url')->textInput(['autofocus' => true]) ?>
            </div>
            <?php /*
            <div class="col-lg-6">
                <?= $form->field($urlForm, 'desired_short_url')->textInput() ?>
            </div>
            */
            ?>
            <div class="col-lg-6">
                <?= $form->field($urlForm, 'short_url')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            </div>


            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
