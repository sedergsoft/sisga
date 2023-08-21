<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ControlUsuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="control-usuario-form">

    <?php $form = ActiveForm::begin(); ?>
   
        <table align = "center">                     
        <tr>          
               <td style="padding-left: 0px">
                  <?= $form->field($model, 'preg_1')->textarea(['rows' => 1]) ?>
               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($model, 'resp_1')->textarea(['rows' => 1]) ?>

             </td>       
           </tr>    
        <tr>          
               <td style="padding-left: 0px">
                  <?= $form->field($model, 'preg_2')->textarea(['rows' => 1]) ?>
                
               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($model, 'resp_2')->textarea(['rows' => 1]) ?>

             </td>       
           </tr> 
           
        
       
        
        <tr>          
               <td style="padding-left: 0px">
                          <?= $form->field($model, 'preg_3')->textarea(['rows' => 1]) ?>

               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($model, 'resp_3')->textarea(['rows' => 1]) ?>

             </td>       
           </tr>           
           <tr>
               <td style="padding-left: 0px">
                 
                            <?= $form->field($model, 'preg_4')->textarea(['rows' => 1]) ?>

             </td>               
               <td style="padding-left: 100px">
                  
                      <?= $form->field($model, 'resp_4')->textarea(['rows' => 1]) ?>
  
               </td> 
           </tr>
          
           
           <tr>
               <td style="padding-left: 0px">
                  <?= $form->field($model, 'preg_5')->textarea(['rows' => 1]) ?>

               </td>         
               <td style="padding-left: 100px">
                   <?= $form->field($model, 'resp_5')->textarea(['rows' => 1]) ?>
 </td>
             
            
           </tr>
    </table>


   
    



    
    
   
    
    


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
