<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vehiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehiculo-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($model,"tipo_vehiculoid")->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(frontend\models\TipoVehiculo::find()->asArray()->all(), 'id', 'tipo_vehiculo'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de vehiculo'],
                                                                    ]);

                                                                        ?> 
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"modelo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"marca")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model,"matricula")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                           
                            
                          
                            
                        </div><!-- .row -->
                      
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
