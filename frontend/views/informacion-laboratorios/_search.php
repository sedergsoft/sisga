<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\InformacionLaboratoriosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informacion-laboratorios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresaid') ?>

    <?= $form->field($model, 'cant') ?>

    <?= $form->field($model, 'terminados') ?>

    <?= $form->field($model, 'porciento') ?>

    <?php // echo $form->field($model, 'cant_func') ?>

    <?php // echo $form->field($model, 'cant_no_func') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
