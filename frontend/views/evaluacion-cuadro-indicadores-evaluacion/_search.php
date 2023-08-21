<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadroIndicadoresEvaluacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-cuadro-indicadores-evaluacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'evaluacion_cuadroid') ?>

    <?= $form->field($model, 'Indicadores_evaluacionid') ?>

    <?= $form->field($model, 'evaluacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
