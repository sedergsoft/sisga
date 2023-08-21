<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LimitacionesSalud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="limitaciones-salud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'limitacionesid')->textInput() ?>

    <?= $form->field($model, 'saludid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
