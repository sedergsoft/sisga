<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Directivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="directivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuadroid')->textInput() ?>

    <?= $form->field($model, 'cargos_direccionid')->textInput() ?>

    <?= $form->field($model, 'años_cargo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
