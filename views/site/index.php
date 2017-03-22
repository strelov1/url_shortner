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


        <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin(['id' => 'url-form', 'options' => ['data-pjax' => true]]); ?>
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
                    <?= Html::button('Save', [
                        'id' => 'save_url',
                        'onclick' => 'save()',
                        'class' => 'btn btn-success',
                    ]) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
<script>
    function save() {
        $('#url-form').removeAttr("data-pjax");
        $('#url-form').submit();
        //$.post('/', $('#url-form').serialize());
    }
</script>