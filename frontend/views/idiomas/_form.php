<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Idiomas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="idiomas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idioma')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
