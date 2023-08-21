<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;

?>
  <?php $form = ActiveForm::begin(['id' => 'dynamic-form'],['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="cuadro-familiar-form">
<?php if(Yii::$app->session->hasFlash("error_validacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => 'Los datos correspondientes a la  Trayectoria como directivo están incorrectos o incompletos.']);
        ?>
    <?php endif; ?>

<div class="row">
     

        <div class="col-lg-3" >
            <?= $form->field($modelSalud, 'estado_saludid')->widget(Select2::className(),[
                'data'=>ArrayHelper::map(frontend\models\EstadoSalud::find()->asArray()->all(), 'id', 'estado_salud'),
                'pluginOptions'=>['placeholder'=>'Selecione el estado de salud..'],
            ]) ->label('Estado de Salud')?>
        </div>        
        <div class="col-lg-6" >
            <?= $form->field($modelLimitaciones, 'limitacion')->textInput() ->label('Limitaciones de Salud')?>
        </div>        
</div>
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
                'formId' => 'dynamic-formsalud',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsEnfermedad as $i => $modelEnfermedad): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Address</h3>
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
     <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>