<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Experiencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="experiencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'años_cargo_actual')->textInput() ?>

    <?= $form->field($model, 'meses_cargo_actual')->textInput() ?>

    <?= $form->field($model, 'años_cuadro')->textInput() ?>

    <?= $form->field($model, 'meses_cuadro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
