<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado_saludid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
