<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Familiar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiar-form">

    <?php $form = ActiveForm::begin(); ?>

    
     <div class="row" style="margin-left: 0px;">

         
         
         
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar,"segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                        </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3" >
                                <?= $form->field($modelPersonaFamiliar,"sexo")->widget(Select2::className(), [
                                                                                                                 'data'=> [1=>'M',
                                                                                                                           2=>'F',


                                                                                                                     ],
                                                                                                                'options' => ['placeholder' => 'Sexo'],
                   
                ]) ?> 
                       
                            </div>
         

                                        <div class="col-sm-3">
                                            <?= $form->field($model,"tipo_familiar")->widget(Select2::className(),[
                                                'data' => ArrayHelper::map(frontend\models\TipoFamiliar::find()->asArray()->all(), 'id', 'tipo'),
                                                                         'options' => ['placeholder' => 'Seleccione el tipo de Familiar...'],
                                                                    ]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model,"centro_estudio_trabajo")->textInput(['maxlength' => true]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model,"integracions[]")->textInput(['maxlength' => true]) ?>

                                        </div>
                                  </div>
                                  <div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model,"conviviente")->checkbox([$checked = false, ]) ?>

                                        </div>
                                     
                                     </div>
                             
                                       
                                </div>
                         

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
