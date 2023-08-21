<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaMilitarMilitanciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trayectoria-militar-militancia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trayectoria_militarid') ?>

    <?= $form->field($model, 'militanciaid') ?>

    <?= $form->field($model, 'fecha_entrada') ?>

    <?= $form->field($model, 'fecha_baja') ?>

    <?php // echo $form->field($model, 'causa_baja') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
