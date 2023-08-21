<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuentasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'representatividad') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'total_cuentas_vencidas') ?>

    <?= $form->field($model, 'no_vencidas') ?>

    <?= $form->field($model, 'saldo_sentencias_judiciales') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'cxc_litigio') ?>

    <?php // echo $form->field($model, 'nm_no_vencida') ?>

    <?php // echo $form->field($model, 'efectos') ?>

    <?php // echo $form->field($model, 'mn_total_vencida') ?>

    <?php // echo $form->field($model, 'ExC_litigio') ?>

    <?php // echo $form->field($model, 'ventas_acumuladas') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'tipo_cuentaid') ?>

    <?php // echo $form->field($model, 'efectiviadad') ?>

    <?php // echo $form->field($model, 'vencidas') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
