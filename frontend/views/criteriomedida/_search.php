<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CriteriomedidaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criteriomedida-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'orden') ?>

    <?= $form->field($model, 'Descripcion') ?>

    <?= $form->field($model, 'UM') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'Objetivoid') ?>

    <?php // echo $form->field($model, 'direccionid') ?>

    <?php // echo $form->field($model, 'topeid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
