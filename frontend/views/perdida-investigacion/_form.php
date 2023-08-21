<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerdidaInvestigacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perdida-investigacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'importe_total')->textInput() ?>

    <?= $form->field($model, 'cant_expedientas')->textInput() ?>

    <?= $form->field($model, 'fuera_termino')->textInput() ?>

    <?= $form->field($model, 'valor_fuera_termino')->textInput() ?>

    <?= $form->field($model, 'tipo_expedienteid')->textInput() ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
