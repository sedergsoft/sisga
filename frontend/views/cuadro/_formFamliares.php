<?php

use yii\helpers\Html;
//use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
     

        

                <?php foreach ($modelsFamiliares as $indexFamiliares => $modelFamiliares): ?>
                <div >
                    
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelFamiliares->isNewRecord) {
                                echo Html::activeHiddenInput($modelFamiliares, "[{$indexFamiliares}]id");
                            }
                        ?>
                         <div class="row" style="margin-left: 0px;">
                             
                                  <div class="row">

                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]tipo_familiar")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoFamiliar::find()->asArray()->all(), 'id', 'tipo'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo de familiar...'],
                   
                ]) ?> 
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]centro_estudio_trabajo")->textInput(['maxlength' => true]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]integracions[]")->textInput(['maxlength' => true]) ?>

                                        </div>
                                  </div>
                                  <div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]conviviente")->checkbox([$checked = false, ]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]sancionado")->checkbox(['onclick'=>"MostrarInfo(this,'sancionados')"/*'ObtenerClic2("sancionados")'*/,$checked = false]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]viaje")->checkbox(['onclick'=>"MostrarInfo(this,'viajesfamiliares')"/*'ObtenerClic2("viajesfamiliares")'*/,$checked = false]) ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelFamiliares, "[{$indexFamiliares}]residenteExterior")->checkbox(['onclick'=>"MostrarInfo(this,'FamiliarResidente')"/*'ObtenerClic2("viajesfamiliares")'*/,$checked = false]) ?>

                                        </div>
                                     </div>
                             
                             
                             
                                   
  <div style="margin-top: 50px">


            <div class="row viajesfamiliares" id="viajesfamiliares-0-0" style="display: none">   
           
                                <?= $this->render('_formViajes', [
                                                                            'form' => $form,
                                                                            'indexFamiliares' => $indexFamiliares,
                                                                            'modelsViajesFamiliares' => $modelsViajesFamiliares[$indexFamiliares],
                                                                        ]) ?>
                            
                     
            
        </div>
    </div>
      
                             
                                   
                                </div>
                               
                                
                                 
                        </div>
                      
                    </div>
                </div>
            <?php endforeach; ?>
         

         
