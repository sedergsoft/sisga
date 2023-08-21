<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectualIdiomas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preparacion-intelectual-idiomas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'preparacion_intelectualid')->textInput() ?>

    <?= $form->field($model, 'idiomasid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
