<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EnfermedadSalud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enfermedad-salud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enfermedadid')->textInput() ?>

    <?= $form->field($model, 'saludid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
