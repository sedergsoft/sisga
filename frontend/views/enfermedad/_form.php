<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Enfermedad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enfermedad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enfermedad')->textInput() ?>

    <?= $form->field($model, 'tratamiento')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
