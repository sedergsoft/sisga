<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoArma */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-arma-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_arma')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
