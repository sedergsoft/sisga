<?php

use yii\helpers\Html;
//use wbraganca\dynamicform\DynamicFormWidget;
//use kartik\select2\Select2;
use kartik\date\DatePicker;

?>
     


            <?php foreach ($modelsFamiliarExterior as $i => $modelFamiliarExterior): ?>
             
                    <div class=" panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> <h4 align = "center"> <strong>Datos De Residencia </strong></h4></h3>
                        <div class="clearfix"></div>
                    </div>
                
                    <div class="panel-body" style="margin-left: 20px;">
                        <?php
                            // necessary for update action.
                       
                            if (! $modelFamiliarExterior->isNewRecord) {
                                echo Html::activeHiddenInput($modelFamiliarExterior, "[{$i}]id");
                            }
                        ?>
                
                            
                        <div class="row">
                                
                            
                            <div class="col-sm-3">
                                <?= $form->field($modelFamiliarExterior, "[{$i}]pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelFamiliarExterior, "[{$i}]nacionalidad")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                           
                                                    
                        </div><!-- .row -->
                    </div>
                 </div>
                 
            <?php endforeach; 
         
