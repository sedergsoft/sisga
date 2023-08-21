<?php
use kartik\form\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;
?>
 <?php $form = ActiveForm::begin(['id' => 'dynamic-form'],['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="cuadro-familiar-form">
<?php if(Yii::$app->session->hasFlash("error_validacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => $style], 'body' => $mensaje]);
        ?>
    <?php endif; ?>

<div class="row">
        
        <hr>
        <h3 align = "center"> Preparación Intelectual</h3>
        <hr>

        <div class="col-lg-3" >
                <?= $form->field($modelPreIntel, 'nivel_escolaridad')->widget(Select2::className(), [
                     'data'=> [0=>'9no grado',
                               1=>'Pre-universitario',
                               2=>'Universitario',
                              
                              

                         ],
                    'options' => ['placeholder' => 'Nivel escolar'],])
                   ?>
        </div>
        <div class="col-lg-3" >
                <?= $form->field($modelPreIntel, 'Especialidad')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3" >
                <?= $form->field($modelPreIntel, 'categoria_docente')->widget(Select2::className(), [
                     'data'=> [3=>'Ninguno',
                               1=>'Profesor Auxialiar',
                               2=>'Profesor Titular',

                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione su categoria docente..'],
                   
                ]) ?> 
        </div>
    <div class="row">
        <div class="col-lg-3" >
                <?= $form->field($modelPreIntel, 'grado_cientifico')->widget(Select2::className(), [
                     'data'=> [0=>'Ninguno',
                               1=>'Licenciado',
                               2=>'Ingeniero',
                               3=>'Master',
                               4=>'Doctor',
                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione el grado cientifico..'],
                   
                ]) ?>
        </div>
    </div>
        <div class="col-lg-3" >
                <?= $form->field($modelPreIntel, 'informatica')->widget(Select2::className(), [
                     'data'=> [0=>'Ninguno',
                               1=>'Básico',
                               2=>'Medio',
                               3=>'Avanzado',
                               4=>'Profesional'
                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione su nivel informático..'],
                   
                ]) ?>
        </div>
        <div class="col-sm-3">
            
            <?php    echo   $form->field($modelMiliatanciaPolitica, 'miitancia_politicid')->widget(Select2::className(), [
                     'data'=>ArrayHelper::map(frontend\models\MiitanciaPolitic::find()->asArray()->all(), 'id', 'tipo'),
     'options' => ['placeholder' => 'Seleccione la militancia...', 'multiple' => true],   'pluginOptions' => [
        'allowClear' => true
    ],
]);?>
        </div>
        

        
        <div class="col-sm-3">
                    <?= $form->field($model, 'ubicacion_tiempo_guerra')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2" style="margin-top: 20px" >
                   <?= $form->field($model, 'reserva_cuadro')->checkbox(['style'=>'margin-top: 2px'])
                   ?>
        </div>
    </div> 
       
    
    
    <div>
            
                     
                        
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-download-alt"></i>  Idiomas </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsIdiomas', // required: css class selector
                'widgetItem' => '.itemIdiomas', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemIdiomas', // css class
                'deleteButton' => '.remove-itemIdiomas', // css class
                'model' => $modelsIdiomas[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'idiomasid',
                    'nivel',
                    
                ],
            ]); ?>

            <div class="container-itemsIdiomas"><!-- widgetContainer -->
         
            <?php foreach ($modelsIdiomas as $i => $modelIdiomas): ?>
          
                <div class="itemIdiomas panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Idioma</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemIdiomas btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemIdiomas btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                    
                            if (! $modelIdiomas->isNewRecord) {
                                echo Html::activeHiddenInput($modelIdiomas, "[{$i}]preparacion_intelectualid");
                            }
                    
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-4">
                                <?= $form->field($modelIdiomas, "[{$i}]idiomasid")->textInput(['maxlength' => true])->label('Idioma') ?>
                       
                            </div>
                            
                            <div class="col-sm-4">
                                <?= $form->field($modelIdiomas, "[{$i}]nivel")->widget(Select2::className(), [
                     'data'=> [
                               0=>'Básico',
                               1=>'Medio',
                               2=>'Avanzado',
                               3=>'Profesional'
                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione su nivel en el idioma..'],
                   
                ]) ?> 
                       
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
        <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-success']) ?>
    </div>
        

    <?php ActiveForm::end(); ?>
            </div>    
    