<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoVehiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-vehiculo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_vehiculo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
