<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Direcciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direcciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'calle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'piso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entre_calle_uno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entre_calle_dos')->textInput() ?>

    <?= $form->field($model, 'Reparto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provinciaid')->textInput() ?>

    <?= $form->field($model, 'municipioid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
