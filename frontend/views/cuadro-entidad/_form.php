<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroEntidad */
/* @var $form kartik\form\ActiveForm; */
?>

<div class="cuadro-entidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuadro_id')->textInput() ?>

    <?= $form->field($model, 'entidad_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
