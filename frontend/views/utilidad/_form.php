<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Utilidad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan')->textInput() ?>

    <?= $form->field($model, 'vreal')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'real_anterior')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_anual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'real_acum_plan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IPUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IRUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IPGI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IRGI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
