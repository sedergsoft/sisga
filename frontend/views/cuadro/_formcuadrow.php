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
 <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="cuadro-familiar-form">
<?php if(Yii::$app->session->hasFlash("error_validacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => $style], 'body' => $mensaje]);
        ?>
    <?php endif; ?>
    <div class =" container">

    
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
            <div class="col-lg-4" >
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
                   
                ])->label('C. Piel') ?> 
            </div>
            <div class="col-lg-2" >
                <?= $form->field($model, 'color_ojos')->textInput(['maxlength' => true])->label('C. Ojos') ?>
            </div>
            <div class="col-lg-2" >
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
                                                     'maxFileSize'=> 982
    ],

            
            
            
        ])?>              
        
        </div>
</div>
      
  
          
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-success']) ?>
    </div>
        

    <?php ActiveForm::end(); ?>
            </div>    

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