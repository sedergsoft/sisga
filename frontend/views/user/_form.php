<?php


use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\widgets\MaskedInput;

use backend\models\Rol;
use frontend\models\Entidad;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation'=>TRUE]); ?>
 <?php if(Yii::$app->session->hasFlash("Exixte_usuario")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Ya existe un presidente, no se puede crear otro... "]);
        ?>
     <?php endif; ?>
    <hr>
    <br>
    <table align = "center">                     
        <tr>          
               <td style="padding-left: 0px">
                  <?= $form->field($trabajador, 'nombre')->textInput(['maxlength' => 20,'style' => 'width:300px']) ?>
               </td>      
             
             <td style="padding-left: 100px">
                  <?= $form->field($trabajador, 'primerApellido')->textInput(['maxlength' => 35,'style' => 'width:300px']) ?>
             </td>       
           </tr>    
        <tr>          
               <td style="padding-left: 0px">
                  <?= $form->field($trabajador, 'segundoApellido')->textInput(['maxlength' => 20,'style' => 'width:300px']) ?>
               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($trabajador, 'CI')->textInput(['maxlength' => 11,'style' => 'width:300px']) ?>
           
             </td>       
           </tr> 
           
        
       
        
        <tr>          
               <td style="padding-left: 0px">
                          <?= $form->field($trabajador, 'telefono')->widget(MaskedInput::className()
                    ,[
             'mask'=>'999-999-9999'   
            ]) ?>
        </div>
                  
               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($trabajador, 'email')->textInput(['maxlength' =>120 ,'style' => 'width:300px']) ?>
                 
             </td>       
           </tr>           
           <tr>
               <td style="padding-left: 0px">
                 
                           <?= $form->field($model, 'username')->textInput(['maxlength' => 35,'style' => 'width:300px']) ?>
             </td>               
               <td style="padding-left: 100px">
                  
                      <?= $form->field($model, 'rolid')->widget(kartik\select2\Select2::className(),[
                        'data'=> yii\helpers\ArrayHelper::map(Rol::find()->where('id!=1')->all(), 'id', 'rol'),
                        'pluginOptions'=>['placeholder'=>'Selecione la funcion de usuario'],
                    ])?>  
               </td> 
           </tr>
          
           
           <tr>
               <td style="padding-left: 0px">
                  <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 250,'style' => 'width:300px']) ?>
               </td>         
               <td style="padding-left: 100px">
                  <?= $form->field($model, "password_repeat")->passwordInput(['maxlength' => 250,'style' => 'width:300px']) ?>
               </td>
             
               <tr>
               <td colspan="2">
             <?=                          
                     $form->field($model, 'direccionid')->widget(kartik\select2\Select2::className(),[
                    'data'=> yii\helpers\ArrayHelper::map(Entidad::find()->all(), 'id', 'nombre_corto'),
                    'pluginOptions'=>['placeholder'=>'Selecione la entidad..'
                        
                        ],
                         
                    ])?>
                   
               </td>
           </tr>
           </tr>
    </table>

    <div class="form-group" align = "center" style="padding-left: 5px">
        <br>
        <?= Html::submitButton($model->isNewRecord ? 'Insertar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>