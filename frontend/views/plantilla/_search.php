<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlantillaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plantilla-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cant_trabajadores') ?>

    <?= $form->field($model, 'cant_cuadros') ?>

    <?= $form->field($model, 'trabajadores_cubierta') ?>

    <?= $form->field($model, 'cuadros_cubierta') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
