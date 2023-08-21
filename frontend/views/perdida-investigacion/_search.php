<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerdidaInvestigacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perdida-investigacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'importe_total') ?>

    <?= $form->field($model, 'cant_expedientas') ?>

    <?= $form->field($model, 'fuera_termino') ?>

    <?= $form->field($model, 'valor_fuera_termino') ?>

    <?php // echo $form->field($model, 'tipo_expedienteid') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
