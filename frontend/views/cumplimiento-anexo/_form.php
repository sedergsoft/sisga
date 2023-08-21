<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CumplimientoAnexo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cumplimiento-anexo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cumplimientoid')->textInput() ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'idtabla')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
