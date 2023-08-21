<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuadro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'personaCI') ?>

    <?= $form->field($model, 'Lugar_nacimiento') ?>

    <?= $form->field($model, 'ciudadania') ?>

    <?= $form->field($model, 'color_piel') ?>

    <?php // echo $form->field($model, 'color_ojos') ?>

    <?php // echo $form->field($model, 'color_pelo') ?>

    <?php // echo $form->field($model, 'estatura') ?>

    <?php // echo $form->field($model, 'peso') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'preparacion_intelectualid') ?>

    <?php // echo $form->field($model, 'centro_trabajoid') ?>

    <?php // echo $form->field($model, 'cargoid') ?>

    <?php // echo $form->field($model, 'trayectoria_militarid') ?>

    <?php // echo $form->field($model, 'ubicacion_tiempo_guerra') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'vehiculo') ?>

    <?php // echo $form->field($model, 'arma') ?>

    <?php // echo $form->field($model, 'ingresos_monetarios') ?>

    <?php // echo $form->field($model, 'beneficio_ingreso') ?>

    <?php // echo $form->field($model, 'reserva_cuadro') ?>

    <?php // echo $form->field($model, 'saludid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
