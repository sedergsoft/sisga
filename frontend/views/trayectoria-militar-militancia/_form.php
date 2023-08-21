<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaMilitarMilitancia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trayectoria-militar-militancia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trayectoria_militarid')->textInput() ?>

    <?= $form->field($model, 'militanciaid')->textInput() ?>

    <?= $form->field($model, 'fecha_entrada')->textInput() ?>

    <?= $form->field($model, 'fecha_baja')->textInput() ?>

    <?= $form->field($model, 'causa_baja')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
