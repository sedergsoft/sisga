<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CumplimientoAnexoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cumplimiento-anexo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cumplimientoid') ?>

    <?= $form->field($model, 'anexoid') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'idtabla') ?>

    <?= $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
