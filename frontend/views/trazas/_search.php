<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrazasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trazas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdTraza') ?>

    <?= $form->field($model, 'IdUsuario') ?>

    <?= $form->field($model, 'tarea_realizada') ?>

    <?= $form->field($model, 'Tabla_Afectada') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'valor_antiguo') ?>

    <?php // echo $form->field($model, 'valor_actual') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
