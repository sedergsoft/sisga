<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preparacion-intelectual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nivel_escolaridad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Especialidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grado_cientifico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_docente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'informatica')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
