<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FamiliarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_familiar') ?>

    <?= $form->field($model, 'personaCI') ?>

    <?= $form->field($model, 'centro_estudio_trabajo') ?>

    <?= $form->field($model, 'conviviente') ?>

    <?php // echo $form->field($model, 'sancionado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
