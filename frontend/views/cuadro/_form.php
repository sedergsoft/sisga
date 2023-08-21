<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;
/* @var $this yii\web\View */
/* @var $model frontend\models\Cuadro */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>
<div class="cuadro-form">
  <?php  
   
  
  echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                 [
                     'label' => 'DropdownA',
                     'content' => 'DropdownA, Anim pariatur cliche...',
                 ],
                 [
                     'label' => 'DropdownB',
                     'content' => 'DropdownB, Anim pariatur cliche...',
                 ],
            ],
        ],
    ],
]);

?>

    <?php $form = ActiveForm::begin( ['id' => 'dynamic-form']); ?>
    <div class="row" >
        <hr>
        <h3 align = "center"> Datos personales</h3>
        <hr>
            <div class="col-lg-4" >
                <?= $form->field($modelPersona, 'Nombre')->textInput(['maxlength' => true])?>
            </div>
            <div class="col-lg-4" >
                <?= $form->field($modelPersona, 'primer_apellido')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4" >
                <?= $form->field($modelPersona, 'segundo_apellido')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3" >
                <?= $form->field($modelPersona, 'CI')->textInput(['maxlength' => true]) ?>
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
                   
                ]) ?> 
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
            <div class="col-lg-3" >
            <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

            </div>
    </div>
<div class="row">
        <div class="col-lg-6" >
        
<?php
/*
echo $form->field($model, 'provinciaid')->widget(Select2::classname(), [
       'data' => ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia')]);
 
// Child # 1
echo $form->field($model, 'Lugar_nacimiento')->widget(DepDrop::classname(), [
    'options'=>['id'=>'municipio'],
    'pluginOptions'=>[
        'depends'=>['provinciaid'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/cuadro/child'])
    ]
]);*/


echo $form->field($model, 'provinciaid')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
    'options' => ['placeholder' => 'Seleccione la provincia de nacimiento...'],
]);
?>
        </div>
            <div class="col-lg-6" >           
     
<?php
echo $form->field($model, 'Lugar_nacimiento')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(frontend\models\Municipio::find()->asArray()->all(), 'id', 'municipio'),
     'options' => ['placeholder' => 'Seleccione el municipio de nacimiento...'],
]);
 
/* Child level 1
 $form->field($model, 'Lugar_nacimiento')->widget(DepDrop::classname(), [
    'data'=>  ArrayHelper::map(frontend\models\Municipio::find()->all(), 'id', 'municipio'),
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['id'],
        'url' => Url::to(['/cuadro/child']),
        'loadingText' => 'Loading child level 1 ...',
    ]
]);



// Child level 2
/*echo $form->field($account, 'lev2')->widget(DepDrop::classname(), [
    'data'=> [9=>'Savings'],
    'options' => ['placeholder' => 'Select ...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['account-lev1'],
        'url' => Url::to(['/account/child-account']),
        'loadingText' => 'Loading child level 2 ...',
    ]
]);
 */
      ?>  
    </div>    
    
   
            <?php ?>
       
         
    </div> 


         
<div class="row">
    
        <div class="col-lg-4" >
            <?= $form->field($model, 'ciudadania')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4" >
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4" >

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

</div>     
    <div class="row">
        
        <hr>
        <h3 align = "center"> Preparación Intelectual</h3>
        <hr>

        <div class="col-lg-4" >
                <?= $form->field($modelPreIntel, 'nivel_escolaridad')->widget(Select2::className(), [
                     'data'=> [0=>'9no grado',
                               1=>'Pre-universitario',
                               2=>'Universitario',
                              
                              

                         ],
                    'options' => ['placeholder' => 'Nivel escolar'],])
                   ?>
        </div>
        <div class="col-lg-4" >
                <?= $form->field($modelPreIntel, 'Especialidad')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4" >
                <?= $form->field($modelPreIntel, 'categoria_docente')->widget(Select2::className(), [
                     'data'=> [0=>'Ninguno',
                               1=>'Profesor Auxialiar',
                               2=>'Profesor Titular',

                         ],
                    'pluginOptions'=>['placeholder'=>'Selecione su categoria docente..'],
                   
                ]) ?> 
        </div>
      </div>
    <div class="row">
        <div class="col-lg-4" >
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
        <div class="col-lg-4" >
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
        
        <div class="col-lg-2" >
                   <?= $form->field($model, 'reserva_cuadro')->checkbox(['style'=>'margin-top: 35px'])
                   ?>
        </div>

        
    </div>

   
        <hr>
        <h3 align = "center"> Datos Laborales</h3>
        <hr>

<div class="row">
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
            <?= $form->field($modelCentroTrab, 'telefono')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelCentroTrab, 'email')->textInput() ?>
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'municipioid')->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\Municipio::find()->asArray()->all(), 'id', 'municipio'),
                    'pluginOptions'=>['placeholder'=>'Selecione el municipio..'],
                   
                ]) ?>  
        </div>
        <div class="col-lg-3" >
            <?= $form->field($modelDirCTA, 'provinciaid')->widget(Select2::className(), [
                     'data'=> ArrayHelper::map(frontend\models\Provincia::find()->asArray()->all(), 'id', 'provincia'),
                    'pluginOptions'=>['placeholder'=>'Selecione la Provincia..'],
                   
                ]) ?> 
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
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
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
               
        <h3 align = "center"><input type="checkbox" name="directivo" value="" onclick="mostrar('.directivo')" />  Trayectoria como directivo</h3>
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

        <hr>
        <h3 align = "center"> Trayectoria Laboral</h3>
        <hr>
       
<div>
        
    
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-briefcase"></i>  Centros laborales</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsTrayectoriaLab[0],
                'formId' => 'dynamic-formTrayectoriaLaboral',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsTrayectoriaLab as $i => $modelCentroLab): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Centro de trabajo</h3>
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
                                echo Html::activeHiddenInput($modelCentroLab, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-8">
                                <?= $form->field($modelCentroLab, "[{$i}]centro_trabajoid")->textInput(['maxlength' => true])->label('Centro Laboral') ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]ocupacion")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                    ]
                                                                                                                ]);?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelCentroLab, "[{$i}]fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha de inicio ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
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

<div>
        <hr>
        <h3 align = "center"> Lugares de Residencia en los ultimos 20 años </h3>
        <hr>

    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-home"></i>  Residencias</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsResidencias[0],
                'formId' => 'dynamic-formResidencia',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsResidencias as $i => $modelResidencia): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Residencia</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelResidencia->isNewRecord) {
                                echo Html::activeHiddenInput($modelResidencia, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelResidencia, "[{$i}]direccionesid")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelResidencia, "[{$i}]fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...'],
                                                                                                                    'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                    ]
                                                                                                                ]);?>
                       
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelResidencia, "[{$i}]fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]);?>
                       
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
        <h3 align = "center"> Estudios Realizados a partir de la enseñanza media </h3>
        <hr>

    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-book"></i>  Centros de Estudios </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsTrayectoriaEst[0],
                'formId' => 'dynamic-formEnseñanza',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsTrayectoriaEst as $i => $modelTrayectoriaEst): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Centro de Estudios</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelTrayectoriaEst->isNewRecord) {
                                echo Html::activeHiddenInput($modelTrayectoriaEst, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <?= $form->field($modelTrayectoriaEst, "[{$i}]centro_estudiosid")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelTrayectoriaEst, "[{$i}]fecha_inicio")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]); ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelTrayectoriaEst, "[{$i}]fecha_fin")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]); ?>
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
        <h3 align = "center"><input type="checkbox" name="directivo" value="" onclick="mostrar('.escuela_politica')" />  Escuelas políticas cursadas</h3>
        <hr>
        <div class="row escuela_politica" style="display: none">   
       
        

    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-bookmark"></i>  Escuelas Politicas </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsEscuelaPoliticaCuadro[0],
                'formId' => 'dynamic-formEscPoli',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsEscuelaPoliticaCuadro as $i => $modelescuelapolitica): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Curso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelescuelapolitica, "[{$i}]escuela_politicaid")->textInput(['maxlength' => true]) ?>
                       
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
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
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
        
        <div>

            <hr>
            <h3 align = "center"><input type="checkbox" name="directivo" value="" onclick="mostrar('.trayectoria_militar')" />  Trayectoria Militar</h3>
            <hr>
            <div class="row trayectoria_militar" style="display: none">   
       
            
           
        <div class="row">
            
            <div class="row">
                <div class="col-sm-4">
                   
                    <?= $form->field($modelTrayectoriaMilitar, 'grado_militar')->textInput() ?>

                </div>
        
                
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'militanciaid')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'fecha_entrada')->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
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
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($modelsTrayecctoriaMiliMili, 'causa_baja')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'ubicacion_tiempo_guerra')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
                   
        </div>
            
<div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-tag"></i>  Preparación Militar Recibida  </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsEscuelaPoliticaCuadro[0],
                'formId' => 'dynamic-formPrepMili',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPreparacionMilitar as $i => $modelPreparacionMilitar): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Curso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
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
        
        <div>

          
             <hr>
            <h3 align = "center"><input type="checkbox" name="directivo" value="" onclick="mostrar('.estancia_exterior')" />  Estancia en el exterior</h3>
            <hr>
            <div class="row estancia_exterior" style="display: none">   
       
            
            
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-plane"></i>  Viajes al exterior </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsExtanciaExt[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsExtanciaExt as $i => $modelExtanciaExt): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Estancia</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelExtanciaExt, "[{$i}]tipo")->textInput(['maxlength' => true]) ?>
                       
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
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
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
            <h3 align = "center"><input type="checkbox" name="directivo" value="" onclick="mostrar('.condecoraciones')" /> Condecoraciones,distinciones y  estimulos</h3>
            <hr>
            <div class="row condecoraciones" style="display: none">   
       
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-certificate"></i>  Condecoraciones </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsCondecoraciones[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsCondecoraciones as $i => $modelCondecoraciones): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Condecoración</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelExtanciaExt, "[{$i}]fecha")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
                            </div>
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
           
            <h3 align = "center"><input type="checkbox" name="directivo" value="" onclick="mostrar('.Sanciones')" /> Sanciones </h3>
            <hr>
            <div class="row Sanciones" style="display: none">   
       
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-fire"></i>  Sanciones </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsSanciones[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsSanciones as $i => $modelSanciones): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Sanción</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelSanciones, "[{$i}]tipo")->textInput(['maxlength' => true]) ?>
                       
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
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
                            </div>
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
            <h3 align = "center"><input type="checkbox" name="Vehiculos" value="" onclick="mostrar('.Vehiculos')" /> Vehiculos </h3>
            <hr>
            <div class="row Vehiculos" style="display: none">   
       
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-road"></i>  Vehiculos </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsVehiculo[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsVehiculo as $i => $modelVehiculo): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Vehiculo</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelVehiculo, "[{$i}]tipo_vehiculoid")->textInput(['maxlength' => true]) ?>
                       
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
            <h3 align = "center"><input type="checkbox" name="Armas" value="" onclick="mostrar('.Armas')" /> Armas </h3>
            <hr>
            <div class="row Armas" style="display: none">   
            <hr>
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-font"></i>  Armas </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsArma[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsArma as $i => $modelArma): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Arma</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <?= $form->field($modelArma, "[{$i}]tipo_armaid")->textInput(['maxlength' => true]) ?>
                       
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
            <h3 align = "center"> Datos Familiares </h3>
            <hr>
            
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Familiar </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPersonaFamiliar[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php foreach ($modelsPersonaFamiliar as $i => $modelPersonaFamiliar): ?>
            <?php foreach ($modelsFamiliares as $i => $modelFamiliares): ?>
            <?php foreach ($modelsSancionados as $i => $modelSancionados): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Familiar</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelPersonaFamiliar->isNewRecord) {
                                echo Html::activeHiddenInput($modelPersonaFamiliar, "[{$i}]id");
                            }
                            if (! $modelFamiliares->isNewRecord) {
                                echo Html::activeHiddenInput($modelFamiliares, "[{$i}]id");
                            }
                            if (! $modelSancionados->isNewRecord) {
                                echo Html::activeHiddenInput($modelSancionados, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$i}]CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$i}]Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$i}]primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliar, "[{$i}]segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelFamiliares, "[{$i}]tipo_familiar")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelFamiliares, "[{$i}]centro_estudio_trabajo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelFamiliares, "[{$i}]integracions[]")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelFamiliares, "[{$i}]sancionado")->checkbox(['onclick'=>'mostrar(".sancionado")', 'style'=>'margin-top:30px']) ?>
                       
                            </div>
                            </div>
                        <hr>
                        
                        <div class="row sancionado" style="display: none">
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelSancionados, "[{$i}]sancion")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelSancionados, "[{$i}]motivo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSancionados, "[{$i}]fecha")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
                            </div>
                           
                            
                            
                                         
                            
                        </div><!-- .row -->

                      
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

                
        <div>

            <hr>
            <h3 align = "center"> Otras personas que conviven en su vivienda </h3>
            <hr>
            
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Conviviente </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsOtrosPersonaFamiliar[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php foreach ($modelsOtrosPersonaFamiliar as $i => $modelOtrosPersonaFamiliar): ?>
            <?php foreach ($modelsOtrosFamiliares as $i => $modelOtrosFamiliares): ?>
            <?php foreach ($modelsConvivienteSancionados as $i => $modelConvivienteSancionados): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Conviviente</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelOtrosPersonaFamiliar->isNewRecord) {
                                echo Html::activeHiddenInput($modelOtrosPersonaFamiliar, "[{$i}]id");
                            }
                            if (! $modelFamiliares->isNewRecord) {
                                echo Html::activeHiddenInput($modelOtrosFamiliares, "[{$i}]id");
                            }
                            if (! $modelConvivienteSancionados->isNewRecord) {
                                echo Html::activeHiddenInput($modelConvivienteSancionados, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelOtrosPersonaFamiliar, "[{$i}]CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelOtrosPersonaFamiliar, "[{$i}]Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelOtrosPersonaFamiliar, "[{$i}]primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelOtrosPersonaFamiliar, "[{$i}]segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelOtrosFamiliares, "[{$i}]tipo_familiar")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelOtrosFamiliares, "[{$i}]centro_estudio_trabajo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelOtrosFamiliares, "[{$i}]integracions[]")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                                <div class="col-sm-2">
                                <?= $form->field($modelOtrosFamiliares, "[{$i}]sancionado")->checkbox(['onclick'=>'mostrar(".sancionados_1")', 'style'=>'margin-top:30px']) ?>
                       
                            </div>
                            </div>
                        <hr>
                        <div class="row sancionados_1" style="display: none">
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelConvivienteSancionados, "[{$i}]sancion")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelConvivienteSancionados, "[{$i}]motivo")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelConvivienteSancionados, "[{$i}]fecha")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
                                                                                                                    ]
                                                                                                                ]) ?>
                       
                            </div>
                            </div>
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
  
    
      <div>


             <hr>
            <h3 align = "center"><input type="checkbox" name="Armas" value="" onclick="mostrar('.viajesfamiliares')" /> Viajes de personas que residen en el hogar </h3>
            <hr>
            <div class="row viajesfamiliares" style="display: none">   
            <hr>
           
            
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Viajes de familiares </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class 
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsViajesFamiliares[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php //foreach ($modelsPersonaFamiliarViaje as $i => $modelPersonaFamiliarViaje): ?>
            <?php foreach ($modelsViajesFamiliares as $i => $modelViajesFamiliares): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Familiar</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelViajesFamiliares->isNewRecord) {
                                echo Html::activeHiddenInput($modelViajesFamiliares, "[{$i}]id");
                            }
                            /*if (! $modelPersonaFamiliarViaje->isNewRecord) {
                                echo Html::activeHiddenInput($modelPersonaFamiliarViaje, "[{$i}]id");
                            }*/
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-4">
                                <?= $form->field($modelViajesFamiliares, "[{$i}]familiarid")->textInput(['maxlength' => true])->label('Nombre del Familiar') ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelViajesFamiliares, "[{$i}]pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelViajesFamiliares, "[{$i}]fecha")->widget(DatePicker::classname(), [
                                                                                                                    'options' => ['placeholder' => 'Entre la fecha ...',
                                                                                                                        'label'=> 'Hasta',
                                                                                                                        ],
                                                                                                                     
                                                                                                                        'pluginOptions' => [
                                                                                                                        'autoclose'=>true,
                                                                                                                        'format' => 'dd/mm/yyyy',
                                                                                                                       'endDate' => date('dd,mm,yyyy'),
                                                                                                                       
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
    </div>
    </div>
          
                  
        <div>

            
            
              <hr>
            <h3 align = "center"><input type="checkbox" name="Armas" value="" onclick="mostrar('.residentesfamiliares')" /> Familiares residentes en el Exterior </h3>
            <hr>
            <div class="row residentesfamiliares" style="display: none">   
            <hr>
            
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Residentes en el exterior </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPersonaFamiliarExterior[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php foreach ($modelsPersonaFamiliarExterior as $i => $modelPersonaFamiliarExterior): ?>
            <?php foreach ($modelsFamiliarExterior as $i => $modelFamiliarExterior): ?>
            <?php foreach ($modelsFamiliaresExterior as $i => $modelFamiliaresExterior): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Familiar</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelPersonaFamiliarExterior->isNewRecord) {
                                echo Html::activeHiddenInput($modelPersonaFamiliarExterior, "[{$i}]id");
                            }
                            if (! $modelFamiliarExterior->isNewRecord) {
                                echo Html::activeHiddenInput($modelFamiliarExterior, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliarExterior, "[{$i}]CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliarExterior, "[{$i}]Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliarExterior, "[{$i}]primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelPersonaFamiliarExterior, "[{$i}]segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelFamiliarExterior, "[{$i}]tipo_familiar")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelFamiliaresExterior, "[{$i}]pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelFamiliaresExterior, "[{$i}]nacionalidad")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            </div>
                            
                            
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
        </div>          
  
                  
        <div>

            
            
               <hr>
            <h3 align = "center"><input type="checkbox" name="Armas" value="" onclick="mostrar('.residentesconocidos')" /> Conocidos o extranjeros residentes en el exterior </h3>
            <hr>
            <div class="row residentesconocidos" style="display: none">   
            <hr>
            
            
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-user"></i>  Conocidos </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsConocidoFamiliarExterior[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php foreach ($modelsConocidoFamiliarExterior as $i => $modelConocidoFamiliarExterior): ?>
            <?php foreach ($modelsConocidoExterior as $i => $modelConocidoExterior): ?>
            <?php foreach ($modelsConocidosExterior as $i => $modelConocidosExterior): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Conocidos</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelConocidoFamiliarExterior->isNewRecord) {
                                echo Html::activeHiddenInput($modelConocidoFamiliarExterior, "[{$i}]id");
                            }
                            if (! $modelConocidoExterior->isNewRecord) {
                                echo Html::activeHiddenInput($modelConocidoExterior, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelConocidoFamiliarExterior, "[{$i}]CI")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelConocidoFamiliarExterior, "[{$i}]Nombre")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelConocidoFamiliarExterior, "[{$i}]primer_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelConocidoFamiliarExterior, "[{$i}]segundo_apellido")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            </div>
                            
                            <div class="row">
                                
                            <div class="col-sm-3">
                                <?= $form->field($modelConocidoExterior, "[{$i}]tipo_familiar")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelConocidosExterior, "[{$i}]pais")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelConocidosExterior, "[{$i}]nacionalidad")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            </div>
                            
                            
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
        </div>
        <div>
            
            <hr>
            <h3 align = "center"> Otros ingresos recibidos </h3>
            <hr>
            
                        
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-download-alt"></i>  Ingresos </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsIngresosMonetarios[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php foreach ($modelsIngresosMonetarios as $i => $modelIngresosMonetarios): ?>
   
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Ingreso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelIngresosMonetarios->isNewRecord) {
                                echo Html::activeHiddenInput($modelIngresosMonetarios, "[{$i}]id");
                            }
                    
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-6">
                                <?= $form->field($modelIngresosMonetarios, "[{$i}]tipo_ingresosid")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelIngresosMonetarios, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                         
                            </div>
                          
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
           
           
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
        </div>   
   
        <div>
            
            <hr>
            <h3 align = "center"> Otros ingresos familiares de los cuales se beneficia </h3>
            <hr>
            
                        
    <div class="panel panel-default">
        <div class="panel-heading" align = "center"><h4><i class="glyphicon glyphicon-download-alt"></i>  Ingresos </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsOtrosIngresosMonetarios[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'enfermedad',
                    'tratamiento',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
         
            <?php foreach ($modelsOtrosIngresosMonetarios as $i => $modelOtrosIngresosMonetarios): ?>
            <?php foreach ($modelsBeneficioIngresos as $i => $modelBeneficioIngresos): ?>
   
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"> Ingreso</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                          
                            if (! $modelOtrosIngresosMonetarios->isNewRecord) {
                                echo Html::activeHiddenInput($modelOtrosIngresosMonetarios, "[{$i}]id");
                            }
                    
                            if (! $modelBeneficioIngresos->isNewRecord) {
                                echo Html::activeHiddenInput($modelsBeneficioIngresos, "[{$i}]id");
                            }
                    
                        ?>
                        <div class="row">
                            
                                
                            <div class="col-sm-4">
                                <?= $form->field($modelOtrosIngresosMonetarios, "[{$i}]tipo_ingresosid")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelOtrosIngresosMonetarios, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                         
                            <div class="col-sm-4">
                                <?= $form->field($modelBeneficioIngresos, "[{$i}]familiarid")->textInput(['maxlength' => true]) ?>
                       
                            </div>
                         
                            </div>
                          
                          
                            
                        </div><!-- .row -->
                      
                    </div>
                </div>
            <?php endforeach; ?>
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
        </div>
<script >
function mostrar(a)
{
$(document).ready(function()
{
      
     $(a).toggle();
   
});    
}



</script>