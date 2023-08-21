<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\IngresosMonetarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingresos-monetarios-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class=" row">
        <div class="col-lg-6">
            

    <?= $form->field($model, 'tipo_familiarid')->widget(\kartik\select2\Select2::className(),
            [
                'data' => ArrayHelper::map(frontend\models\TipoFamiliar::find()->asArray()->all(), 'id', 'tipo'),
     'options' => ['placeholder' => 'Seleccione el tipo de Familiar...'],
]);  ?>
        </div>
        <div class="col-lg-6">

    <?= $form->field($model, 'tipo_ingresosid')->widget(\kartik\select2\Select2::className(),
            [
                'data' => ArrayHelper::map(frontend\models\TipoIngresos::find()->asArray()->all(), 'id', 'tipo'),
     'options' => ['placeholder' => 'Seleccione el tipo de Ingreso...'],
]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
