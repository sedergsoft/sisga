<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroSanciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuadro-sanciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sancionesid')->textInput() ?>

    <?= $form->field($model, 'cuadroid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
