<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CentroTrabajo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-trabajo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'centro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccionesid')->textInput() ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idorganismo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
