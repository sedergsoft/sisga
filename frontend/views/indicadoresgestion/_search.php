<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\IndicadoresgestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indicadoresgestion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fecha_chequeo') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'direccionid') ?>

    <?= $form->field($model, 'UM') ?>

    <?php // echo $form->field($model, 'topeid') ?>

    <?php // echo $form->field($model, 'orden') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
