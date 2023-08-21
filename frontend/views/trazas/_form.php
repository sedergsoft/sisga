<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trazas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trazas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdUsuario')->textInput() ?>

    <?= $form->field($model, 'tarea_realizada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tabla_Afectada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'valor_antiguo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'valor_actual')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
