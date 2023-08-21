<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ExperienciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="experiencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'años_cargo_actual') ?>

    <?= $form->field($model, 'meses_cargo_actual') ?>

    <?= $form->field($model, 'años_cuadro') ?>

    <?= $form->field($model, 'meses_cuadro') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
