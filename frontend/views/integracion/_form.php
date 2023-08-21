<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Integracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="integracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'organizacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
