<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-cuadro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'complemento_textual') ?>

    <?= $form->field($model, 'señalamientos') ?>

    <?= $form->field($model, 'concluciones') ?>

    <?= $form->field($model, 'resultado_evaluacion') ?>

    <?php // echo $form->field($model, 'superacion') ?>

    <?php // echo $form->field($model, 'confecionado') ?>

    <?php // echo $form->field($model, 'entidad') ?>

    <?php // echo $form->field($model, 'cuadroid') ?>

    <?php // echo $form->field($model, 'reservaid') ?>

    <?php // echo $form->field($model, 'proyeccionid') ?>

    <?php // echo $form->field($model, 'opinion_evaluadoid') ?>

    <?php // echo $form->field($model, 'experienciaid') ?>

    <?php // echo $form->field($model, 'periodo_evaluadoid') ?>

    <?php // echo $form->field($model, 'organismoidorganismo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
