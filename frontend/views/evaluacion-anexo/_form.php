<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionAnexo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-anexo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'evaluacionid')->textInput() ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'anexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idtabla')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
