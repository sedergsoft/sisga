<?php

use frontend\models\Entidad;
use frontend\models\Provincia;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entidad */
/* @var $form kartik\form\ActiveForm; */
?>

<div class="entidad-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-lg-6">

            <?= $form->field($model, 'nombre_corto')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'superiorid')->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(Entidad::find()->asArray()->andFilterWhere(['not', ['id' => ArrayHelper::map(\frontend\models\Plantilla::find()->all(), 'id','empresaid')]])->all(), 'id', 'nombre'),

                    'pluginOptions'=>['placeholder'=>'Selecione la Empresa..'],
                   
                ])?>
        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'provincia_id')->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(Provincia::find()->asArray()->all(), 'id', 'provincia'),

                    'pluginOptions'=>['placeholder'=>'Selecione la Provincia..'],
                   
                ]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
