<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FamiliarIntegracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiar-integracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'familiarid')->textInput() ?>

    <?= $form->field($model, 'integracionid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
