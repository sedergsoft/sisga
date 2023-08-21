<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ImpuestoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="impuesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'venta35_plan') ?>

    <?= $form->field($model, 'ventas35_vreal') ?>

    <?= $form->field($model, 'ventas2_plan') ?>

    <?= $form->field($model, 'ventas2_vreal') ?>

    <?= $form->field($model, 'especial17_vreal') ?>

    <?php // echo $form->field($model, 'especial17_real2') ?>

    <?php // echo $form->field($model, 'recupercion_vreal') ?>

    <?php // echo $form->field($model, 'recuperacion_plan') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
