<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrabajadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'primerApellido') ?>

    <?= $form->field($model, 'segundoApellido') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'CI') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'iduser') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
