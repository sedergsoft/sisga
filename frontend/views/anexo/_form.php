<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anexo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anexo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'anexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tabla')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modelo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'searchmodel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
