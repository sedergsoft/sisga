<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CentroEstudios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-estudios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'centro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipioid')->textInput() ?>

    <?= $form->field($model, 'provinciaid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
