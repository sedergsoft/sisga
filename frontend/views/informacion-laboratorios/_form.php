<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\InformacionLaboratorios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informacion-laboratorios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'cant')->textInput() ?>

    <?= $form->field($model, 'terminados')->textInput() ?>

    <?= $form->field($model, 'porciento')->textInput() ?>

    <?= $form->field($model, 'cant_func')->textInput() ?>

    <?= $form->field($model, 'cant_no_func')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
