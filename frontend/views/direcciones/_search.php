<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DireccionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direcciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'calle') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'edif') ?>

    <?= $form->field($model, 'apto') ?>

    <?php // echo $form->field($model, 'piso') ?>

    <?php // echo $form->field($model, 'entre_calle_uno') ?>

    <?php // echo $form->field($model, 'entre_calle_dos') ?>

    <?php // echo $form->field($model, 'Reparto') ?>

    <?php // echo $form->field($model, 'provinciaid') ?>

    <?php // echo $form->field($model, 'municipioid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
