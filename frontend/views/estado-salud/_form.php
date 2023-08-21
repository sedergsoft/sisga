<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EstadoSalud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-salud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado_salud')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
