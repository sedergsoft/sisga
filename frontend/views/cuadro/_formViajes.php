<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
//use kartik\select2\Select2;
use kartik\date\DatePicker;

?>
     

        
        
    <div class="panel panel-default" style=" width: 1097.5px;margin-left: 5px;">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Viajes de familiares </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperViajes_familiares', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsViajes_familiares', // required: css class selector
                'widgetItem' => '.itemViajes_familiares', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemViajes_familiares', // css class 
                'deleteButton' => '.remove-itemViajes_familiares', // css class
                'model' => $modelsViajesFamiliares[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-itemsViajes_familiares"><!-- widgetContainer -->
         
            <?php //foreach ($modelsPersonaFamiliarViaje as $i => $modelPersonaFamiliarViaje): ?>
            <?php foreach ($modelsViajesFamiliares as $indexViajes => $modelViajesFamiliares): ?>
                <div class="itemViajes_familiares panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Familiar</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemViajes_familiares btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemViajes_familiares btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelViajesFamiliares->isNewRecord) {
                                echo Html::activeHiddenInput($modelViajesFamiliares, "[{$indexFamiliares}][{$indexViajes}]id");
                            }
                            /*if (! $modelPersonaFamiliarViaje->isNewRecord) {
                                echo Html::activeHiddenInput($modelPersonaFamiliarViaje, "[{$i}]id");
                            }*/
                        ?>
                        <div class="row">
                            
                                
                          
                            <div class="col-sm-4">
                                <?= $form->field($modelViajesFamiliares, "[{$indexFamiliares}][{$indexViajes}]pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelViajesFamiliares, "[{$indexFamiliares}][{$indexViajes}]fecha")->widget(DatePicker::classname(), [
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
                       
                            
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            <?php //endforeach; ?>
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
