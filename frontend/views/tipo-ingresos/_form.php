<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoIngresos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-ingresos-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class=" row ">
        <div class="col-lg-6">
    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>
        </div>
    <div class="form-group">
    </div>
    </div>
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

</div>
