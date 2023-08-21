<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PeriodoEvaluado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodo-evaluado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desde')->textInput() ?>

    <?= $form->field($model, 'hasta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
