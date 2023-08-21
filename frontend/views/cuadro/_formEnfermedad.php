<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
 
<div>
        <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-plus"></i> Enfermedades que padece</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsEnfermedad[0],
                'formId' => 'dynamic-formEnfermedades',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsEnfermedad as $i => $modelEnfermedad): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Enfermedad</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelEnfermedad->isNewRecord) {
                                echo Html::activeHiddenInput($modelEnfermedad, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($modelEnfermedad, "[{$i}]enfermedad")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                        
                            <div class="col-sm-9">
                                <?= $form->field($modelEnfermedad, "[{$i}]tratamiento")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>
