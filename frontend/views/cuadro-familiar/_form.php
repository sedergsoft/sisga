<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroFamiliar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuadro-familiar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuadroid')->textInput() ?>

    <?= $form->field($model, 'familiarid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
