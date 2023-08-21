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
                  <?= $model->preg_1 ?>
               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($model, 'resp1_user')->textarea(['rows' => 1]) ?>

             </td>       
           </tr>    
        <tr>          
               <td style="padding-left: 0px">
                  <?= $model->preg_2?>
                
               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($model, 'resp2_user')->textarea(['rows' => 1]) ?>

             </td>       
           </tr> 
           
        
       
        
        <tr>          
               <td style="padding-left: 0px">
                          <?= $model->preg_3 ?>

               </td>      
             
             <td style="padding-left: 100px">
                 <?= $form->field($model, 'resp3_user')->textarea(['rows' => 1]) ?>

             </td>       
           </tr>           
           <tr>
               <td style="padding-left: 0px">
                 
                            <?= $model->preg_4 ?>

             </td>               
               <td style="padding-left: 100px">
                  
                      <?= $form->field($model, 'resp4_user')->textarea(['rows' => 1]) ?>
  
               </td> 
           </tr>
          
           
           <tr>
               <td style="padding-left: 0px">
                  <?= $model->preg_5 ?>

               </td>         
               <td style="padding-left: 100px">
                   <?= $form->field($model, 'resp5_user')->textarea(['rows' => 1]) ?>
 </td>
             
            
           </tr>
    </table>


   
    



    
    
   
    
    


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Recuperar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
