<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CentroTrabajoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-trabajo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'centro') ?>

    <?= $form->field($model, 'direccionesid') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'idorganismo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
