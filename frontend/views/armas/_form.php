<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Armas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armas-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($model,"tipo_armaid")->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\TipoArma::find()->asArray()->all(), 'id', 'tipo_arma'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de Arma'],
                                                                    ]);

                                                                        ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"tipo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"modelo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"marca")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"no_licencia")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                                               
                        </div><!-- .row -->
                      
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
