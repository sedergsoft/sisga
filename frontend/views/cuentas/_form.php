<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cuentas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'representatividad')->textInput() ?>

    <?= $form->field($model, 'total_cuentas_vencidas')->textInput() ?>

    <?= $form->field($model, 'no_vencidas')->textInput() ?>

    <?= $form->field($model, 'saldo_sentencias_judiciales')->textInput() ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'cxc_litigio')->textInput() ?>

    <?= $form->field($model, 'nm_no_vencida')->textInput() ?>

    <?= $form->field($model, 'efectos')->textInput() ?>

    <?= $form->field($model, 'mn_total_vencida')->textInput() ?>

    <?= $form->field($model, 'ExC_litigio')->textInput() ?>

    <?= $form->field($model, 'ventas_acumuladas')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'tipo_cuentaid')->textInput() ?>

    <?= $form->field($model, 'efectiviadad')->textInput() ?>

    <?= $form->field($model, 'vencidas')->textInput() ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
