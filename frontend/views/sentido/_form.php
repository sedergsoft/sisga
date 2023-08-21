<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sentido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sentido')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
