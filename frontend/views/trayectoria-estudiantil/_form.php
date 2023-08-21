<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaEstudiantil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trayectoria-estudiantil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuadroid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
