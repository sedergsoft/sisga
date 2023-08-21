<?php

use yii\helpers\Html;
//use wbraganca\dynamicform\DynamicFormWidget;
//use kartik\select2\Select2;
use kartik\date\DatePicker;

?>
     

        

                 <?php foreach ($modelsSancionados as $k => $modelSancionados): ?>
           
                <div>
                    <div class=" panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> <h4 align = "center"> <strong>Datos De la Sanción </strong></h4></h3>
                        <div class="clearfix"></div>
                    </div>
                 
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            
                            if (! $modelSancionados->isNewRecord) {
                                echo Html::activeHiddenInput($modelSancionados, "[{$k}]id");
                            }
                        ?>
                         <div class="row" style="margin-left: 0px;">
                             
                                  <div class="row">
                                      
                                      
                                      
                                       
                            <div class="col-sm-3">
                                <?= $form->field($modelSancionados, "[{$k}]sancion")->textInput(['maxlength' => true]) ?>
                      
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelSancionados, "[{$k}]motivo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSancionados, "[{$k}]fecha")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
                            </div>
                           
                            
                            
                            
                                        </div>
                                   
                                </div>
                               
                                
                                 
                        </div>
                      
                    </div>
                </div>
            <?php endforeach; ?>
         

         
