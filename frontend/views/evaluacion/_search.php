<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'valor_vreal') ?>

    <?= $form->field($model, 'fechacreado') ?>

    <?= $form->field($model, 'direccionid') ?>

    <?= $form->field($model, 'criteriomedidaid') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'periodo') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
