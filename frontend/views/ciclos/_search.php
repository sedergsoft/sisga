<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CiclosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ciclos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CE') ?>

    <?= $form->field($model, 'CEL') ?>

    <?= $form->field($model, 'CELD') ?>

    <?= $form->field($model, 'CPCE') ?>

    <?= $form->field($model, 'CPCED') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
