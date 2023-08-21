<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proyeccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyeccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_proyeccionid')->textInput() ?>

    <?= $form->field($model, 'tipo_movimientoid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
