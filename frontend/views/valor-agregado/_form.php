<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ValorAgregado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="valor-agregado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan')->textInput() ?>

    <?= $form->field($model, 'vreal')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'plan_anterior')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
