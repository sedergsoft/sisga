<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VariacionGastos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variacion-gastos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'gastosxperdida')->textInput() ?>

    <?= $form->field($model, 'gastosxfaltante')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'anexoid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
