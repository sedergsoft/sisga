<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductividadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productividad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'plan') ?>

    <?= $form->field($model, 'vreal') ?>

    <?= $form->field($model, 'plan_anterior') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'correlacion') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
