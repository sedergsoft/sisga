<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Calificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calificacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'calificacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
