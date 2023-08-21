<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evaluacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-form">
    
    <?php /*echo $criteriomedida->Descripcion ?>
    <?= $criteriomedida->UM ?>
    <?php 
    date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
      if(date('m')< "04")
      {
       echo $criteriomedida->tope->Itrimestre;   
      }
      else{
          if(date('m')>= "04" && date('m') <= "06")
          {
           echo $criteriomedida->tope->IItrimestre;   
          }
          else{
               if(date('m')>"06" && date('m') <= "09")
          {
           echo $criteriomedida->tope->IIItrimestre;   
          }
          else{echo $criteriomedida->tope->IVtrimestre; }
          }
      }
            
   */ ?>
          <?php if(Yii::$app->session->hasFlash("archivo_no_valido")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "El anexo que ha intentado insertar no tiene el formato correcto.Por favor pruebe con otro."]);
        ?>
    <?php endif; ?>
<div id="pricing-table" class="row">
              
                <div >
                    <ul class="plan plan1 featured">
                        <li class="plan-name">
                            <h2><?= 'Criterio '. frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($criteriomedida->id);?></h2>
                        </li>
                          <li>
                              <h4> <?= $criteriomedida->Descripcion  ?></h4>
                        </li>
                        <li class="plan-price">
                            
                            <!-- <div >
                                <span class="price "><?php// $modelindicador->UM?></span>
                              <!--  <small>month</small>-->
                           <!-- </div> -->
                            <div >
                                <span class="price "><sup>  <?php 
    date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
      if(date('m')< "04")
      {
       echo 'I-T';   
      }
      else{
          if(date('m')>= "04" && date('m') <= "06")
          {
           echo 'II-T';   
          }
          else{
               if(date('m')>"06" && date('m') <= "09")
          {
           echo 'III-T';   
          }
          else{echo 'IV-T'; }
          }
      }
            
    ?></sup><?php 
    date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
      if(date('m')< "04")
      {
       echo $criteriomedida->tope->Itrimestre;   
      }
      else{
          if(date('m')>= "04" && date('m') <= "06")
          {
           echo $criteriomedida->tope->IItrimestre;   
          }
          else{
               if(date('m')>"06" && date('m') <= "09")
          {
           echo $criteriomedida->tope->IIItrimestre;   
          }
          else{echo $criteriomedida->tope->IVtrimestre; }
          }
      }?></span>
                              <!--  <small>month</small>-->
                            </div>
                           
                        </li>
                      
                      
                    </ul>
                </div><!--/.col-md-3-->
               
              
            </div>

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'enableClientValidation'=>true]); ?>

    
    <?= $form->field($model, 'valor_vreal')->textInput() ?>

    <?= $form->field($model, 'fechacreado')->widget(\kartik\date\DatePicker::className(),[
        
       'options' => [
          'value' => date('Y-m-d')],
        
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
       // 'value'=> '2019-03-05',
    ]
        
        
        
        
    ])/* ?>

    <?= $form->field($model, 'direccionid')->textInput() ?>

    <?= $form->field($model, 'criteriomedidaid')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'periodo')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput() */?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6,'format'=>'raw']) ?>

 
    
      <?php //echo  Html::button ('Anexos',['class' => 'btn btn-info','onclick'=>'mostrar()','id'=>'btnanexos']) ?>
  <?php echo $form->field($model, 'anexo')->checkbox(['onclick'=>'mostrar()','id'=>'btnanexos']);?>
    
    <div class="row anexo" style="display: none" >
        <hr>
          
        <div class="col-lg-6">
            <?php
                     echo Select2::widget([
                                    'model' => $modelevaluacionanexo,
                                    'attribute' => 'anexoid',
                                    'data' => ArrayHelper::map(\frontend\models\Anexo::find()->all(),'id','anexo'),
                                    'options' => ['placeholder' => 'Selecciona el Tipo de anexo...'],
                                    'pluginOptions' => [
                                    'allowClear' => true
                                                        ],
                                    ]);

                                        ?>
            
        </div>
        <div class="col-lg-6">
                      <?php echo FileInput::widget([
                                                    'model' => $modelevaluacionanexo,
                                                    'attribute' => 'anexo',
                                                    'pluginOptions' => [
                                                    'showPreview' => false,
                                                    'showCaption' => true,
                                                    'showRemove' => false,
                                                    'showUpload' => false
                                                                        ],
                           'options' => ['accept' => ['image/*','xlsx']],
    ]); ?>
        </div>
       

       
<script >
function mostrar()
{
$(document).ready(function()
{
      
     $(".anexo").toggle();
   
});    
}



</script>

<!--<script>

$(document).ready(function()
{
 alert("hola");
        /*if($("#btnanexos").is(".checked"))
 {
     $(".anexo").attr("style","");
 }*/
});


</script>-->

    </div>
  <hr>
  
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





