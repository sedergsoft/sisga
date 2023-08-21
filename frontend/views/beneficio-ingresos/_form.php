<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BeneficioIngresos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="beneficio-ingresos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'familiarid')->textInput() ?>

    <?= $form->field($model, 'ingresos_monetariosid')->textInput() ?>

    <?= $form->field($model, 'cuadroid')->textInput() ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
