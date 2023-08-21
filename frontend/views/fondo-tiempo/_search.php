<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FondoTiempoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fondo-tiempo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'adiestrado') ?>

    <?= $form->field($model, 'indice_utilizacion') ?>

    <?= $form->field($model, 'indice_ausentismo') ?>

    <?= $form->field($model, 'ausentismo_puro') ?>

    <?= $form->field($model, 'promedio_trab_mensual') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'empresaid') ?>

    <?php // echo $form->field($model, 'anexoid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
