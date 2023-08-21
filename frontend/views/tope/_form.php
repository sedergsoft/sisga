<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tope */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tope-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Itrimestre')->textInput() ?>

    <?= $form->field($model, 'IItrimestre')->textInput() ?>

    <?= $form->field($model, 'IIItrimestre')->textInput() ?>

    <?= $form->field($model, 'IVtrimestre')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
