<div  align ="center">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar-pequeno.png" ?> />
    
</div>
<div  align ="center">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/Logo_GA(mediano).png" ?> />
</div>
<div>
    <div  align ="center"  style="margin-top: 20px" >
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar-pequeno.png" ?> />
    
</div>
   
   
</div>

 
<div>
  <hr>  
    <h1> <p align ="center"><?=$nombre?> </p>
               </h1> 
   <hr> 
</div>
<div  align ="center" style="margin-top: 20px">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar-pequeno.png" ?> />
</div> 
<div  align ="center">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar-pequeno.png" ?> />
 
</div>
<div >
    
</div>


<table class=" table">
    <thead>
        <tr>
          
            
        </tr>
    </thead>
    <tbody>
        <?php 
foreach ($datosdireciones as $direccion) 
    
{
  //echo $objetivo; 
?>      <tr class="danger">
            
                <td colspan="10"><?= $direccion['nombre']?></td>
                <td colspan="12"><?= $direccion['responsable']?></td>
                <td colspan="2"><?= " "?></td>
             
            
        </tr>
  <?php  
foreach ($datoscriterios as $criterio)
{
    if($criterio['direccionid'] == $direccion['id'])
    {
        foreach ($datosobjetivos as $objetivo)
        {
         if($criterio['Objetivoid'] == $objetivo['id'])
         {
             
         
        ?>
        <tr class="success">
            
                <td colspan="2"><?= "Criterio ".$objetivo['orden'].'.'.$criterio['orden']?></td>
                <td colspan="12"><?= $criterio['Descripcion']?></td>
                <td colspan="2"><?= $criterio['UM']?></td>
          
             
            <?php
          foreach ($datostopec as $topec)
          {
              if($criterio['topeid']==$topec['id'])
              {?>
                <td colspan="1"><?= $topec['Itrimestre']?></td>   
                <td colspan="1"><?= $topec['IItrimestre']?></td>  
                <td colspan="1"><?= $topec['IIItrimestre']?></td>  
                <td colspan="1"><?= $topec['IVtrimestre']?></td>  
            
             <?php }
          }
            ?>  
        </tr>
        <?php
     foreach ($datosevaluacionCriterio as $evaluacionCriterio) 
    {
        if($evaluacionCriterio['criteriomedidaid']==$criterio['id'])
        {
            foreach ($datosperiodos as $periodos)
            {
                if($periodos['id']==$evaluacionCriterio['periodo'])
                {
                    foreach ($datosuser as $user) 
                        {
                        if($evaluacionCriterio['userid']==$user['id'])
                         {
                            foreach ($datosestado as $estado)
                            {
                                if($evaluacionCriterio['estado']==$estado['id'])
                                {
                    
                    
         ?>
       <tr class="info">
            <td colspan="18">
               Evaluacion del criterio de medida perteneciente al periodo del <?= $periodos['periodo']?>
           
            </td>
           
       </tr> 
       <tr>
            <td colspan="6">
                    Valor real : <?= $evaluacionCriterio['valor_vreal']?> 
            </td>
            <td colspan="6">
                    Infromado por: <?= $user['username']?>
            </td >
            <td colspan="6">
               Estado de la Información : <?= $estado['estado']?>
            </td>
       </tr>
       <tr>
            <td colspan="18">
               <?= $evaluacionCriterio['observaciones']?>
            </td>
       </tr>
       <?php 
        if($evaluacionCriterio['anexo'] == 1 && yii\helpers\ArrayHelper::keyExists($evaluacionCriterio['id'], $anexocriterioid, false))
        {?>
       <tr>
           <td colspan="18" class="warning"> 
               Anexo del criterio <?= $objetivo['orden'].'.'.$criterio['orden']?> 
           </td>
       </tr>
       <tr>
           <td colspan="18"> 
             <?php
                echo $anexocriterioid[$evaluacionCriterio['id']];
             
             ?>
           </td>
       </tr>  
       <tr>
           <td colspan="18"class="inverse">
               <p>  </p>
           </td>
       </tr>
            
        <?php
         }
            
       ?>
       
       
       <?php
                                }
                                }
                            }
       
                        }
                        
       
                }
          }
        }
        
    }
    }
        }
    }//termina el if de los criterios
   
}

}
        
?>
        
    </tbody>
</table>




