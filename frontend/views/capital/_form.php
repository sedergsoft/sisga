<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Capital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="capital-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'anexoid')->textInput() ?>

    <?= $form->field($model, 'activo_circulante')->textInput() ?>

    <?= $form->field($model, 'pasivo_circulante')->textInput() ?>

    <?= $form->field($model, 'Suma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creditos_bancarios')->textInput() ?>

    <?= $form->field($model, 'empresaid')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
