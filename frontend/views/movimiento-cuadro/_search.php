<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MovimientoCuadroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimiento-cuadro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'causas_sustitucion') ?>

    <?= $form->field($model, 'sintesis_biografica') ?>

    <?= $form->field($model, 'resultados_controles') ?>

    <?= $form->field($model, 'fundamentacion') ?>

    <?php // echo $form->field($model, 'consideraciones') ?>

    <?php // echo $form->field($model, 'entidad') ?>

    <?php // echo $form->field($model, 'idcargo_propuesto') ?>

    <?php // echo $form->field($model, 'tipo_movimientoid') ?>

    <?php // echo $form->field($model, 'cuadroid') ?>

    <?php // echo $form->field($model, 'cuadro_sustituido') ?>

    <?php // echo $form->field($model, 'evaluacion_cuadroid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
