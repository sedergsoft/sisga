<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ControlUsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="control-usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'preg_1') ?>

    <?= $form->field($model, 'preg_2') ?>

    <?= $form->field($model, 'preg_3') ?>

    <?php // echo $form->field($model, 'preg_4') ?>

    <?php // echo $form->field($model, 'preg_5') ?>

    <?php // echo $form->field($model, 'resp_1') ?>

    <?php // echo $form->field($model, 'resp_2') ?>

    <?php // echo $form->field($model, 'resp_3') ?>

    <?php // echo $form->field($model, 'resp_4') ?>

    <?php // echo $form->field($model, 'resp_5') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
