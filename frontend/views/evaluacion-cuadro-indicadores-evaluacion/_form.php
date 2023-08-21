<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadroIndicadoresEvaluacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-cuadro-indicadores-evaluacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'evaluacion_cuadroid')->textInput() ?>

    <?= $form->field($model, 'Indicadores_evaluacionid')->textInput() ?>

    <?= $form->field($model, 'evaluacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
