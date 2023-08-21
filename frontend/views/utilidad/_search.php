<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UtilidadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilidad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'plan') ?>

    <?= $form->field($model, 'vreal') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'real_anterior') ?>

    <?php // echo $form->field($model, 'plan_anual') ?>

    <?php // echo $form->field($model, 'real_acum_plan') ?>

    <?php // echo $form->field($model, 'IPUI') ?>

    <?php // echo $form->field($model, 'IRUI') ?>

    <?php // echo $form->field($model, 'IPGI') ?>

    <?php // echo $form->field($model, 'IRGI') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
