<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoMovimiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-movimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_movimiento')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
