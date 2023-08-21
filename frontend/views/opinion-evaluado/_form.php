<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OpinionEvaluado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opinion-evaluado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opinion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reclamacion')->textInput() ?>

    <?= $form->field($model, 'reclamacion_desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
