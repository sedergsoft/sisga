<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cumplimiento */
/* @var $modelindicador frontend\models\IndicadorGestion */
/* @var $form yii\widgets\ActiveForm */
?>

  <?php if(Yii::$app->session->hasFlash("archivo_no_valido")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "El anexo que ha intentado insertar no tiene el formato correcto.Por favor pruebe con otro."]);
        ?>
    <?php endif; ?>

<div id="pricing-table" class="row">
              
                <div >
                    <ul class="plan plan2 featured">
                        <li class="plan-name">
                            <h2><?= 'Indicador '. frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($modelindicador->id);?></h2>
                        </li>
                          <li>
                              <h4> <?= $modelindicador->descripcion  ?></h4>
                        </li>
                        <li class="plan-price">
                            
                            <!-- <div >
                                <span class="price "><?php// $modelindicador->UM?></span>
                              <!--  <small>month</small>-->
                           <!-- </div> -->
                            <div >
                                <span class="price "><sup><?= $modelindicador->tope->sentido->sentido ?></sup><?=$modelindicador->tope->valor?></span>
                              <!--  <small>month</small>-->
                            </div>
                           
                        </li>
                      
                      
                    </ul>
                </div><!--/.col-md-3-->
               
              
            </div>



<!--<div class="container">
    <h4>
        <?php
         date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
        /*$modelindicador->descripcion ?>
    </h4>
    <h4>
        <?= $modelindicador->UM?>
    </h4>
    
    <h4>
        <?= $modelindicador->tope->sentido->sentido .$modelindicador->tope->valor*/?>
    </h4>
    
</div> -->

<div class="cumplimiento-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'enableClientValidation'=>true]);/* ?>

    <?= $form->field($model, 'indicadores_gestionid')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput() */?>

    <?= $form->field($model, 'valor')->textInput() ?>
    
    <?= $form->field($model, 'fecha')->widget(\kartik\date\DatePicker::className(),[
         'options' => [
          'value' => date('Y-m-d')],
    
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
        
        
        
        
    ]) ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6])/* ?>

    <?= $form->field($model, 'estado_cumplimientoid')->textInput() */?>
    
     <?php echo $form->field($model, 'anexo')->checkbox(['onclick'=>'mostrar()','id'=>'btnanexos']);?>
    
    <div class="row anexo" style="display: none" >
        <hr>
          
        <div class="col-lg-6">
            <?php
                     echo Select2::widget([
                                    'model' => $modelcumplimientoanexo,
                                    'attribute' => 'anexoid',
                                    'data' => ArrayHelper::map(\frontend\models\Anexo::find()->/*where(['id'=>26])->*/all(),'id','anexo'),
                                    'options' => ['placeholder' => 'Selecciona el Tipo de anexo...'],
                                    'pluginOptions' => [
                                    'allowClear' => true
                                                        ],
                                    ]);

                                        ?>
            
        </div>
        <div class="col-lg-6">
                      <?php echo FileInput::widget([
                                                    'model' => $modelcumplimientoanexo,
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


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
