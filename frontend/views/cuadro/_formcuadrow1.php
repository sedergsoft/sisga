<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;
use yii\bootstrap\Alert;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use buttflattery\formwizard\FormWizard;
/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroFamiliar */
/* @var $form yii\widgets\ActiveForm */
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
    <div class =" container">
    <?php
$wizard_config = [
	'id' => 'stepwizard',
         'theme'=> FormWizard::THEME_MATERIAL_V,
    'enablePersistence'=>true,
    'labelNext'=>'Siguiente',
    'labelPrev'=>'Anterior',
    'labelRestore'=>'Restaurar',
    'labelFinish'=>'Finalizar',
   
    
	'steps' => [
		1 => [
		 
                        'title'=>'Información Personal',
                        'description'=>'Datos personales del cuadro que se desea agregar',
                        'icon'=>'glyphicon glyphicon-cloud-upload',
                        'type' => FormWizard::STEP_TYPE_PREVIEW,
                       
                        'model'=> [$modelPersona,$model],
                    
                      'fieldConfig'=>[
                                          'modelPersona.Nombre'=>[
                                              'options'=>[
                                                  //'class'=>'form-control'
                                              ],
                                              'inputOptions'=>['col-lg-4'],
                                          ],
                                          'model.personaCI'=>[   
                                              'options'=>[
                                                  'class'=>'col-lg-4 form-control '
                                                        ]
                                              ],
                                          'modelPersona.sexo'=>[   
                                                                'options'=>[
                                                                              'class'=>'col-lg-4 form-control',
                                                                              'widget'=>[Select2::class

                                                                                        ],
                                                                          ],
                                                                ],
                             'except'=>[
                                            'CI',
                                            'preparacion_intelectualid',
                                            'centro_trabajoid',
                                            'cargoid',
                                            'trayectoria_militarid',
                                            'arma',
                                            'ingresos_monetarios',
                                            'beneficio_ingreso',
                                            'reserva_cuadro',
                                            'vehiculo',
                                            'ubicacion_tiempo_guerra',
                                            'saludid',
                                            'fecha_inicio_cargo',
                                        ]
                                      ],
              
		],
		2 => [
			'title' => 'Datos Recidenciales',
                        'description'=>'Datos los lugares donde ha residido',
                       'icon' => 'glyphicon glyphicon-cloud-upload',
			'content' => '<h3>Step 2</h3>This is step 2',
			'skippable' => false,
		],
		3 => [
			'title' => 'Preparación Intelectual',
                        'description'=>'Datos sobre la preparación recibida en los sistemas de enseñanza ',
			'icon' => 'glyphicon glyphicon-transfer',
			'content' => '<h3>Step 3</h3>This is step 3',
		],
	],
	//'complete_content' => "You are done!", // Optional final screen
	//'start_step' => 2, // Optional, start with a specific step
];
?>
    <?= FormWizard::widget($wizard_config )?>
    
    </div>
    
     <div class="row" >
        <hr>
        <h3 align = "center"> Datos personales</h3>
        <hr>
        <div class="row">
            
          <div class="col-lg-4" >
                <?= $form->field($modelPersona, 'Nombre')->textInput(['maxlength' => true])?>
            </div>
            <div class="col-lg-4" >
                <?= $form->field($modelPersona, 'primer_apellido')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4" >
                <?= $form->field($modelPersona, 'segundo_apellido')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3" >
                <?= $form->field($model, 'personaCI')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-1" >
                <?= $form->field($modelPersona, 'sexo')->widget(Select2::className(), [
                     'data'=> [0=>'M',
                               1=>'F',
                              

                         ],
                    'options' => ['placeholder' => 'Sexo'],
                   
                ]) ?> 
            </div>
            <div class="col-lg-1" >
                <?= $form->field($model, 'color_piel')->widget(Select2::className(), [
                     'data'=> [0=>'B',
                               1=>'M',
                               2=>'N',
                               3=>'A',
                              

                         ],
                    'options' => ['placeholder' => 'Piel'],
                   
                ])->label('C. Piel') ?> 
            </div>
            <div class="col-lg-1" >
                <?= $form->field($model, 'color_ojos')->textInput(['maxlength' => true])->label('C. Ojos') ?>
            </div>
            <div class="col-lg-1" >
                <?= $form->field($model, 'color_pelo')->textInput(['maxlength' => true]) ->label('C. Pelo')?>
            </div>
            <div class="col-lg-1" >
                <?= $form->field($model, 'estatura')->textInput() ?>
            </div>
            <div class="col-lg-1" >
                <?= $form->field($model, 'peso')->textInput() ?>
            </div>
            
            <?php /*echo $form->field($model, 'foto')->textInput(['maxlength' => true]) */?>
        </div>  

    </div>

    <div class="row"> 
    <div class="col-lg-4" >           
     
<?php
echo $form->field($model, 'provinciaid')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
     'options' => ['placeholder' => 'Seleccione el provincia de nacimiento...'],
]);

  


?> 
    </div>    
            <div class="col-lg-4" >           
     

 <?= $form->field($model,"Lugar_nacimiento")->widget(DepDrop::classname(), [
                                             //   'data'=> [6=>'Bank'],
                                                'options' => ['placeholder' => 'Seleccione el Municipio de nacimiento...'],
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                'pluginOptions'=>[
                                                    'depends'=>['cuadro-provinciaid'],
                                                    'url' => Url::to(['/direcciones/child-account']),
                                                    'loadingText' => 'Buscando municipios ...',
                                                ]
                                            ]);?>



       
    </div>    
    
        <div class="col-lg-4" >
            <?= $form->field($model, 'ciudadania')->textInput(['maxlength' => true]) ?>
        </div>  
   </div>


         
<div class="row">
    
        <div class="col-lg-4" >
            <?= $form->field($model, 'telefono')->widget(MaskedInput::className()
                    ,[
             'mask'=>'999-999-9999'   
            ]) ?>
        </div>
        <div class="col-lg-4" >

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

    <div class="col-lg-3">
        <?= $form->field($model, 'foto')->widget(FileInput::classname(),[
             'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                                                    'showPreview' => true,
                                                    'showCaption' => false,
                                                    'showRemove' => true,
                                                    'showUpload' => false,
                                                   'browseClass' => 'btn btn-primary btn-block',
                                                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                                     'browseLabel' =>  'Selecione la foto',
                                                     'maxFileSize'=> 25
    ],

            
            
            
        ])?>              
        
        </div>
</div>
    <div class="row">
        <hr>
        <h3 align = "center"> Datos Recidenciales</h3>
        <hr>
 
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-briefcase"></i>  Lugares de Residencia </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperLugaresResidencia', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsLugaresResidencia', // required: css class selector
                'widgetItem' => '.itemLugaresResidencia', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemLugaresResidencia', // css class
                'deleteButton' => '.remove-itemLugaresResidencia', // css class
                'model' => $modelRecidecias[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'fecha_inicio',
                    'fecha_fin',
                    
                ],
            ]); ?>

            <div class="container-itemsLugaresResidencia"><!-- widgetContainer -->
            <?php foreach ($modelRecidecias as $indexRecidencia => $modelResidencia):?>
                <div class="itemLugaresResidencia panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Recidencia</h3>
                        <div class="pull-right">
                            <!--<button type="button" class="add-itemLugaresResidencia btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemLugaresResidencia btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                      -->  </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                           if (! $modelResidencia->isNewRecord) {
                            echo Html::activeHiddenInput($modelResidencia, "[{$indexRecidencia}]id");
                         }
                        ?>
                         <div class="row" style="margin-left: 0px;">
                             
                                <div class="row">

                                        <div class="col-lg-5">
                                            <?= $form->field($modelResidencia, "[{$indexRecidencia}]fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Fecha en que llego a esta residencia',
                                                                                                                        'label'=> 'Desde',
                                                                                                                        'name' => 'fecha_inicio'
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]]);?>
                                                                                  
                                        </div>

                                        <div class="col-lg-6">
                                           <?= $form->field($modelResidencia, "[{$indexRecidencia}]fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Fecha en que abandono la esta residencia ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]]);?>
                                        </div>
                   
                                </div>
                                <div class="row">
                                    <?php echo $this->render('_formDireccionesResidencia', [
                                                            'form' => $form,
                                                            'indexResidencia' => $indexRecidencia,
                                                            'modelDirResidencia' => $modelDirResidencia[$indexRecidencia],
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
                     'data'=> [0=>'Ninguno',
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
    

    
        <hr>
        <h3 align = "center"> Datos Laborales</h3>
        <hr>

<div class="row">
    
    
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelCentroTrab, 'centro')?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($modelCentroTrab, 'idorganismo')->widget(Select2::className(),[
                'data'=> ArrayHelper::map( frontend\models\Organismo::find()->asArray()->andFilterWhere(['Status'=>1])->all(), 'idorganismo', 'organismo'),
                 'pluginOptions'=>['placeholder'=>'Selecione el Organismo..'],
            ])  ?>
        </div>        
    </div>
    
    <div class="row">
        <div class="col-lg-4" >
            <?= $form->field($modelDirCTA, 'calle')->textInput() ?>
        </div>
        <div class="col-lg-2" >
            <?= $form->field($modelDirCTA, 'numero')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'entre_calle_uno')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'entre_calle_dos')->textInput() ?>
        </div>
    </div>
   
    
    <div class="row">
        <div class="col-lg-3" >
            <?= $form->field($modelCentroTrab, 'telefono')->widget(MaskedInput::className()
                    ,[
             'mask'=>'999-999-9999'   
            ]) ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelCentroTrab, 'email')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'provinciaid')->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                    'pluginOptions'=>['placeholder'=>'Selecione la Provincia..'],
                   
                ]) ?> 
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'municipioid')->widget(DepDrop::classname(), [
                                             //   'data'=> [6=>'Bank'],
                                                'options' => ['placeholder' => 'Seleccione el Municipio...'],
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                'pluginOptions'=>[
                                                    'depends'=>['direcciones-provinciaid'],
                                                    'url' => Url::to(['/direcciones/child-account']),
                                                    'loadingText' => 'Buscando municipios ...',
                                                ]
                                            ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3" >
            <?= $form->field($modelCargoActual, 'cargo')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($model, 'fecha_inicio_cargo')->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                    ]
                                                                                                                ]);?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelCargoActual, 'salario')->textInput() ?>
        </div>
    </div>
 </div>
    
<div class="row">
        <hr>
               
        <h3 align = "center"><?= $form->field($modelDirectivo, 'active')->checkbox(['onclick'=>'mostrar(".directivo")' ]) ?>
         </h3>
        <hr>
        <div class="row directivo" style="display: none">   
        <div class="col-lg-4" >
            <?= $form->field($modelDirectivo, 'años_cargo')->textInput() ?>
        </div>
        <div class="col-lg-6" >
            <?= $form->field($modelDirectivo, 'cargos_direccionid')->widget(Select2::className(),[
              'data'=>ArrayHelper::map(frontend\models\CargosDireccion::find()->asArray()->all(), 'id', 'tipo'),  
                
            ]) ?>
        </div>
            
        </div>
        
</div>
    
        
<div class="row">
        <hr>
        <h3 align = "center"> Estado Salud</h3>
        <hr>

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
                'widgetContainer' => 'dynamicform_wrapperEnfermedades', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsEnfermedades', // required: css class selector
                'widgetItem' => '.itemEnfermedades', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemEnfermedades', // css class
                'deleteButton' => '.remove-itemEnfermedades', // css class
                'model' => $modelsEnfermedad[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-itemsEnfermedades"><!-- widgetContainer -->
            <?php foreach ($modelsEnfermedad as $i => $modelEnfermedad): ?>
                <div class="itemEnfermedades panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Enfermedades</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemEnfermedades btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemEnfermedades btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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

        
   

<div>

            <hr>
            <h3 align = "center"><?= $form->field($modelTrayectoriaMilitar, 'active')->checkbox(['checked' => false ,'onclick'=>'mostrar(".trayectoria_militar")' ]) ?>
         </h3><hr>
<div class="row trayectoria_militar" style="display: none">   
       
            
           
        <div class="row">
            
            <div class="row">
                <div class="col-sm-4">
                   
                    <?= $form->field($modelTrayectoriaMilitar, 'grado_militar')->textInput() ?>

                </div>
        
                
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'militanciaid')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\Militancia::find()->asArray()->all(), 'id', 'tipo'),
     'options' => ['placeholder' => 'Organizaciones a las que pertenece...'],
]); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'fecha_entrada')->widget(DatePicker::classname(), [
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
            <div class="row">
                
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'fecha_baja')->widget(DatePicker::classname(), [
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
                <div class="col-sm-6">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'causa_baja')->textInput(['maxlength' => true]) ?>
                </div>
                
            </div>
                   
        </div>
            
<div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-tag"></i>  Preparación Militar Recibida  </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperPrepaMil', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsPrepaMil', // required: css class selector
                'widgetItem' => '.itemPrepaMil', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemPrepaMil', // css class
                'deleteButton' => '.remove-itemPrepaMil', // css class
                'model' => $modelsPreparacionMilitar[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'escuela',
                    'curso',
                    'fecha',
                    
                ],
            ]); ?>

            <div class="container-itemsPrepaMil"><!-- widgetContainer -->
            <?php foreach ($modelsPreparacionMilitar as $i => $modelPreparacionMilitar): ?>
                <div class="itemPrepaMil panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Curso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemPrepaMil btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemPrepaMil btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelPreparacionMilitar->isNewRecord) {
                                echo Html::activeHiddenInput($modelPreparacionMilitar, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelPreparacionMilitar, "[{$i}]escuela")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelPreparacionMilitar, "[{$i}]curso")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelPreparacionMilitar, "[{$i}]fecha")->widget(DatePicker::classname(), [
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
                            
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

</div>
</div>           
                    <hr>
        <h3 align = "center"> Trayectoria Laboral</h3>
        <hr>
       
<div>
        
    
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-briefcase"></i>  Centros laborales</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperCentroLab', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsCentroLab', // required: css class selector
                'widgetItem' => '.itemCentroLab', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemCentroLab', // css class
                'deleteButton' => '.remove-itemCentroLab', // css class
                'model' => $modelsTrayectoriaLab[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'centro_trabajo',
                    'ocupacion',
                    'fecha_inicio',
                    'fecha_fin',
                    'motivo_cambio',
                    
                ],
            ]); ?>

            <div class="container-itemsCentroLab"><!-- widgetContainer -->
            <?php foreach ($modelsTrayectoriaLab as $i => $modelCentroLab): ?>
                <div class="itemCentroLab panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Centro de trabajo</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemCentroLab btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemCentroLab btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelEnfermedad->isNewRecord) {
                                echo Html::activeHiddenInput($modelCentroLab, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-8">
                                <?= $form->field($modelCentroLab, "[{$i}]centro_trabajo")->textInput(['maxlength' => true])->label('Centro Laboral') ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]ocupacion")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class ="row ">
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                    ]
                                                                                                                ]);?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                    ]
                                                                                                                ]);?>
                       
                       
                            </div>
                            
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]motivo_cambio")->textInput(['maxlength' => true]) ?>
                       
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
        
            <div class="row">
        <hr>
        <h3 align = "center"> Estudio realizados a parir de la enseñanza media</h3>
        <hr>
 
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-briefcase"></i>  Centro de Estudio </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperCentroEstudio', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsCentroEstudio', // required: css class selector
                'widgetItem' => '.itemCentroEstudio', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemCentroEstudio', // css class
                'deleteButton' => '.remove-itemCentroEstudio', // css class
                'model' => $modelsTrayectoriaEst[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'fecha_inicio',
                    'fecha_fin',
                    'centro',
                    'provinciaid',
                    'municipioid',
                    
                ],
            ]); ?>

            <div class="container-itemsCentroEstudio"><!-- widgetContainer -->
            <?php foreach ($modelsTrayectoriaEst as $indexTrayectoriaEst => $modelTrayectoriaEst):?>
                <div class="itemCentroEstudio panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Centro de Estudios</h3>
                        <div class="pull-right">
                           <!-- <button type="button" class="add-itemCentroEstudio btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemCentroEstudio btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        --></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                           if (! $modelTrayectoriaEst->isNewRecord) {
                            echo Html::activeHiddenInput($modelTrayectoriaEst, "[{$indexTrayectoriaEst}]trayectoria_estudiantilid");
                         }
                        ?>
                         <div class="row" style="margin-left: 0px;">
                             
                                  <div class="row">

                                        <div class="col-lg-5">
                                            <?= $form->field($modelTrayectoriaEst, "[{$indexTrayectoriaEst}]fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Fecha en que llego a esta residencia',
                                                                                                                        'label'=> 'Desde',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]]);?>
                                                                                  
                                        </div>

                                        <div class="col-lg-6">
                                           <?= $form->field($modelTrayectoriaEst, "[{$indexTrayectoriaEst}]fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Fecha en que abandono la esta residencia ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'yyyy-mm-dd',
                                                                                                                       'endDate' => date('yyyy-mm-dd'),
                                                                                                                       
                                                                                                                    ]]);?>
                                        </div>
                   
                                </div>
                                <div class="row">
                                    <?php echo $this->render('_formCentrosEstudio', [
                                                            'form' => $form,
                                                            'indexTrayectoriaEst' => $indexTrayectoriaEst,
                                                            'modelsCentroEstudios' => $modelsCentroEstudios[$indexTrayectoriaEst],
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
   <div>     
        <hr>
        <h3 align = "center"><?= $form->field($modelsEscuelaPoliticaCuadro[0], 'active')->checkbox(['onclick'=>'mostrar(".escuela_politica")' ]) ?>
         </h3><hr>
        <div class="row escuela_politica" style="display: none">   
       
        

    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-bookmark"></i>  Escuelas Politicas </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperEscuelaPolitica', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsEscuelaPolitica', // required: css class selector
                'widgetItem' => '.itemEscuelaPolitica', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemEscuelaPolitica', // css class
                'deleteButton' => '.remove-itemEscuelaPolitica', // css class
                'model' => $modelsEscuelaPoliticaCuadro[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'escuela_politicaid',
                    'curso',
                    'fecha',
                   
                    
                ],
            ]); ?>

            <div class="container-itemsEscuelaPolitica"><!-- widgetContainer -->
            <?php foreach ($modelsEscuelaPoliticaCuadro as $i => $modelescuelapolitica): ?>
                <div class="itemEscuelaPolitica panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Curso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemEscuelaPolitica btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemEscuelaPolitica btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelescuelapolitica->isNewRecord) {
                                echo Html::activeHiddenInput($modelescuelapolitica, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelescuelapolitica, "[{$i}]escuela_politicaid")->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\EscuelaPolitica::find()->asArray()->all(), 'id', 'escuela'),
     'options' => ['placeholder' => 'Seleccione la escuela política...'],
])?>

                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelescuelapolitica, "[{$i}]curso")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelescuelapolitica, "[{$i}]fecha")->widget(DatePicker::classname(), [
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
                            
                        
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

        </div>
    
   </div>
        
         <hr>
             <h3 align = "center"><?= $form->field($modelsExtanciaExt[0], 'active')->checkbox(['onclick'=>'mostrar(".estancia_exterior")' ]) ?>
         </h3><hr>
            <div class="row estancia_exterior" style="display: none">   
       
            
                   
            
                  <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-plane"></i>  Viajes al exterior </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperEstanciaEXterior', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsEstanciaEXterior', // required: css class selector
                'widgetItem' => '.itemEstanciaEXterior', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemEstanciaEXterior', // css class
                'deleteButton' => '.remove-itemEstanciaEXterior', // css class
                'model' => $modelsExtanciaExt[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'tipo',
                    'pais',
                    'fecha',
                    'cargo',
                    'motivo',
                    
                ],
            ]); ?>

            <div class="container-itemsEstanciaEXterior"><!-- widgetContainer -->
            <?php foreach ($modelsExtanciaExt as $i => $modelExtanciaExt): ?>
                <div class="itemEstanciaEXterior panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Estancia</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemEstanciaEXterior btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemEstanciaEXterior btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelExtanciaExt->isNewRecord) {
                                echo Html::activeHiddenInput($modelExtanciaExt, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelExtanciaExt, "[{$i}]tipo")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoExtancia::find()->asArray()->all(), 'id', 'tipo'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo estancia ..'],
                   
                ]) ?> 
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelExtanciaExt, "[{$i}]pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelExtanciaExt, "[{$i}]fecha")->widget(DatePicker::classname(), [
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
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelExtanciaExt, "[{$i}]cargo")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <div class="col-sm-4">
                                <?= $form->field($modelExtanciaExt, "[{$i}]motivo")->textInput(['maxlength' => true]) ?>
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
            <hr>
               <h3 align = "center"><?= $form->field($modelsCondecoraciones[0], 'active')->checkbox(['onclick'=>'mostrar(".condecoraciones")' ]) ?>
         </h3><hr>
            <div class="row condecoraciones" style="display: none">   
       
            
                <div class="panel panel-default">
                    <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-certificate"></i>  Condecoraciones </h4></div>
                    <div class="panel-body">
                         <?php DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapperCondecoraciones', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-itemsCondecoraciones', // required: css class selector
                            'widgetItem' => '.itemCondecoraciones', // required: css class
                            'limit' => 8, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-itemCondecoraciones', // css class
                            'deleteButton' => '.remove-itemCondecoraciones', // css class
                            'model' => $modelsCondecoraciones[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'nombre',
                                'fecha',

                            ],
                        ]); ?>

                        <div class="container-itemsCondecoraciones"><!-- widgetContainer -->
                        <?php foreach ($modelsCondecoraciones as $i => $modelCondecoraciones): ?>
                            <div class="itemCondecoraciones panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left"> Condecoración</h3>
                                    <div class="pull-right">
                                        <button type="button" class="add-itemCondecoraciones btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="remove-itemCondecoraciones btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelCondecoraciones->isNewRecord) {
                                            echo Html::activeHiddenInput($modelCondecoraciones, "[{$i}]id");
                                        }
                                    ?>
                                    <div class="row">

                                        <div class="col-sm-8">
                                            <?= $form->field($modelCondecoraciones, "[{$i}]nombre")->textInput(['maxlength' => true]) ?>

                                        </div>
                                        <div class="col-sm-4">
                                            <?= $form->field($modelCondecoraciones, "[{$i}]fecha")->widget(DatePicker::classname(), [
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
                                       



                                    </div><!-- .row -->

                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
    
            </div>


            <hr>
           
            <h3 align = "center"><?= $form->field($modelsSanciones[0], 'active')->checkbox(['onclick'=>'mostrar(".Sanciones")' ]) ?>
         </h3>
            <hr>
            <div class="row Sanciones" style="display: none">   
       
            
                <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-fire"></i>  Sanciones </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperSanciones', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsSanciones', // required: css class selector
                'widgetItem' => '.itemSanciones', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemSanciones', // css class
                'deleteButton' => '.remove-itemSanciones', // css class
                'model' => $modelsSanciones[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'tipo',
                    'sancion',
                    'motivo',
                    'fecha',
                    
                ],
            ]); ?>

            <div class="container-itemsSanciones"><!-- widgetContainer -->
            <?php foreach ($modelsSanciones as $i => $modelSanciones): ?>
                <div class="itemSanciones panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Sanción</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemSanciones btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemSanciones btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSanciones->isNewRecord) {
                                echo Html::activeHiddenInput($modelSanciones, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($modelSanciones, "[{$i}]tipo")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoSancion::find()->asArray()->all(), 'id', 'tipo'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo de sanción..'],
                   
                ]) ?> 
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSanciones, "[{$i}]sansion")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSanciones, "[{$i}]motivo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSanciones, "[{$i}]fecha")->widget(DatePicker::classname(), [
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
                           
                            
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
       
            </div>
           <hr>
            <h3 align = "center"><?= $form->field($modelsVehiculo[0], 'active')->checkbox(['onclick'=>'mostrar(".Vehiculos")' ]) ?>
          </h3>
           
            <hr>
            <div class="row Vehiculos" style="display: none">   
       
            
                 <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-road"></i>  Vehiculos </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperVehiculos', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsVehiculos', // required: css class selector
                'widgetItem' => '.itemVehiculos', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemVehiculos', // css class
                'deleteButton' => '.remove-itemVehiculos', // css class
                'model' => $modelsVehiculo[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'tipo_vehiculoid',
                    'modelo',
                    'marca',
                    'matricula',
                    
                ],
            ]); ?>

            <div class="container-itemsVehiculos"><!-- widgetContainer -->
            <?php foreach ($modelsVehiculo as $i => $modelVehiculo): ?>
                <div class="itemVehiculos panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Vehiculo</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemVehiculos btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemVehiculos btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelVehiculo->isNewRecord) {
                                echo Html::activeHiddenInput($modelVehiculo, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($modelVehiculo, "[{$i}]tipo_vehiculoid")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoVehiculo::find()->asArray()->all(), 'id', 'tipo_vehiculo'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo de Vehículo..'],
                   
                ]) ?> 
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelVehiculo, "[{$i}]modelo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelVehiculo, "[{$i}]marca")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelVehiculo, "[{$i}]matricula")->textInput(['maxlength' => true]) ?>
                       
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
         <hr>
            <h3 align = "center">
           <?= $form->field($modelsArma[0], 'active')->checkbox(['onclick'=>'mostrar(".Armas")' ]) ?>
            </h3>
            <hr>
            <div class="row Armas" style="display: none">   
            <hr>
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-font"></i>  Armas </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperArmas', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsArmas', // required: css class selector
                'widgetItem' => '.itemArmas', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemArmas', // css class
                'deleteButton' => '.remove-itemArmas', // css class
                'model' => $modelsArma[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'tipo_armaid',
                    'tipo',
                    'modelo',
                    'marca',
                    'no_licencia',
                    
                ],
            ]); ?>

            <div class="container-itemsArmas"><!-- widgetContainer -->
            <?php foreach ($modelsArma as $i => $modelArma): ?>
                <div class="itemArmas panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Arma</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemArmas btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemArmas btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelArma->isNewRecord) {
                                echo Html::activeHiddenInput($modelArma, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($modelArma, "[{$i}]tipo_armaid")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoArma::find()->asArray()->all(), 'id', 'tipo_arma'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo de arma..'],
                   
                ]) ?> 
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelArma, "[{$i}]tipo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelArma, "[{$i}]modelo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelArma, "[{$i}]marca")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelArma, "[{$i}]no_licencia")->textInput(['maxlength' => true]) ?>
                       
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

            <hr>
            <h3 align = "center"> Datos Familiares </h3>
            <hr>
            
            
    <div class="panel panel-default" id="Datos_familiares">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Familiar </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperFamiliar', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsFamiliar', // required: css class selector
                'widgetItem' => '.itemFamiliar', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemFamiliar', // css class
                'deleteButton' => '.remove-itemFamiliar', // css class
                'model' => $modelsPersonaFamiliar[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-itemsFamiliar"><!-- widgetContainer -->
         
            <?php foreach ($modelsPersonaFamiliar as $indexPersonafamiliar => $modelPersonaFamiliar): ?>
        
                <div class="itemFamiliar panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Familiar</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemFamiliar btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemFamiliar btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body" id="panel_body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelPersonaFamiliar->isNewRecord) {
                                echo Html::activeHiddenInput($modelPersonaFamiliar, "[{$indexPersonafamiliar}]CI") ;
                            }
                           
                           
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$indexPersonafamiliar}]CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$indexPersonafamiliar}]Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$indexPersonafamiliar}]primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$indexPersonafamiliar}]segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                        </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3" style="margin-top: 15px;">
                                <?= $form->field($modelPersonaFamiliar, "[{$indexPersonafamiliar}]sexo")->widget(Select2::className(), [
                                                                                                                 'data'=> [0=>'M',
                                                                                                                           1=>'F',


                                                                                                                     ],
                                                                                                                'options' => ['placeholder' => 'Sexo'],
                   
                ]) ?> 
                       
                            </div>
                            <div>
                        
                                    <?php echo $this->render('_formFamliares', [
                                                            'form' => $form,
                                                            //'indexPersonafamiliar' => $indexPersonafamiliar,
                                                            'modelsFamiliares' => $modelsFamiliares,
                                                            'modelsViajesFamiliares' =>$modelsViajesFamiliares
                                                        ]) ?>
                            </div><!-- .row -->
                        
                            <div class="row sancionado" id="sancionados-0-0" style="display: none">
                                
                         
                             <?php echo $this->render('_formSancionados', [
                                                            'form' => $form,
                                                            //'indexTrayectoriaEst' => $indexTrayectoriaEst,
                                                            'modelsSancionados' => $modelsSancionados,
                                                        ]) ?>
                            
                            
                            
                                         
                            
                        </div><!-- .row -->
                            <div class="row sancionado" id="FamiliarResidente-0-0" style="display: none">
                                
                         
                             <?php echo $this->render('_formFamiliarResidente', [
                                                            'form' => $form,
                                                            //'indexTrayectoriaEst' => $indexTrayectoriaEst,
                                                            'modelsFamiliarExterior' => $modelsFamiliarExterior,
                                                        ]) ?>
                            
                            
                            
                                         
                            
                        </div><!-- .row -->

                            </div> <!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

   
            
      <!-- 
        ingresos 
      -->   
      
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-fire"></i>  Ingresos  </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperIngresos', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsIngresos', // required: css class selector
                'widgetItem' => '.itemIngresos', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemIngresos', // css class
                'deleteButton' => '.remove-itemIngresos', // css class
                'model' => $modelsIngresosFamiliares[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'tipo',
                    'sancion',
                    'motivo',
                    'fecha',
                    
                ],
            ]); ?>

            <div class="container-itemsIngresos"><!-- widgetContainer -->
            <?php foreach ($modelsIngresosFamiliares as $i => $modelIngresosFamiliares): ?>
                <div class="itemIngresos panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Ingreso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-itemIngresos btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-itemIngresos btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSanciones->isNewRecord) {
                                echo Html::activeHiddenInput($modelIngresosFamiliares, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <?= $form->field($modelIngresosFamiliares, "[{$i}]tipo_familiarid")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoFamiliar::find()->asArray()->all(), 'id', 'tipo'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo de familiar..'],
                   
                ]) ?> 
                            </div>
                            
                            <div class="col-sm-3">
                                <?= $form->field($modelIngresosFamiliares, "[{$i}]tipo_ingresosid")->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\TipoIngresos::find()->asArray()->all(), 'id', 'tipo'),
                    'pluginOptions'=>['placeholder'=>'Selecione el tipo de Ingreso..'],
                   
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
        
            
            
  
          
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
        

    <?php ActiveForm::end(); ?>
            </div>    




<script   >
function mostrar(a)
{
$(document).ready(function()
{
      
    // alert(a);
   $(a).toggle();
     //ObtenerClic2(a);
   
}); 
}
function mostrarSancionado(a)
{
$(document).ready(function()
{
 var name = $(a).attr("id");   
 var clase = $("#"+name).attr("class");
  alert (clase);
// alert (name); 
 //var parent =$("#"+ name).parent().html();
 $("#"+name).removeClass("row sancionado");
 $("#"+name).addClass(name);
 
 var clase = $("#"+name).attr("class");
 alert (clase);
});    
}

function ObtenerClic(a)
{
    $(document).ready(function(){
        $('#Datos_familiares').on('click','input',function(){
            alert($(this).attr('id'));
            var name = $(a).attr("id");   
            var name = $(this).attr('id');   
           // var clase = $("#"+name).attr("class");
 
        //alert($(this).attr('id'));
            $("#"+name).removeClass("row sancionado");
            $("#"+name).addClass(name);
 
        });
    });
}
function ObtenerClic22(a)
{
    $(document).ready(function(){
        $("#familiar-0-sancionado").on('click',function(){
            var name = $(this).attr("id");   
            var id = name.split('-');    
             
        $("#sancionados-"+id[1]+"-0").toggle();
        
        });
    });
    }
function ObtenerClic2mas(a)
{
   
        $(document).ready(function(){
        alert (a);
        });
}
function ObtenerClic3()//funciona pero no como kiero
{
    $(document).ready(function(){
        $('#Datos_familiares').on ('click','input',function(){
            var name = $(this).attr("id");   
            var lugar = name.substring(8,11);    
            var toggle = "sancionados"+lugar+"0";   
        $("#"+toggle).toggle();
        
        });
    });
}
function ObtenerClic1()
{
    $(document).ready(function(){
        $('#panel_body input').click(function(){
            alert($(this).attr('id'));
        });
    });
}



function ObtenerClic2(a)
{
   $(document).ready(function(){
        var name = $("#familiar-0-sancionado").attr("id");   
   
            var lugar = name.substring(8,11);    
            var toggle = a+lugar+"0";   
        $("#"+toggle).toggle();
        
        });;
}

function MostrarInfo(elemet,tipo)//esta es la que funciona
{
   var name = elemet.id;   
   var id = name.split('-');    
   var toogle = "#"+tipo+"-"+id[1]+"-0";        
  $(toogle).toggle();    
 
}
</script>