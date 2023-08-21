
<div  align ="center">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar-pequeno.png" ?> />
    
</div>
<div  align ="center">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/Logo_GA(mediano).png" ?> />
</div>
<div>
    <div  align ="center"  style="margin-top: 10px" >
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar-pequeno.png" ?> />
    
</div>
   
   
</div>

 
<div>
  <hr>  
    <h1> <p align ="center"><?=$nombre?> </p>
               </h1> 
   <hr> 
</div>
<div  align ="center">
                    <img src=<?= Yii::$app->urlManager->baseUrl."/uploads/images/auxiliar.png" ?> />
 
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
foreach ($datosobjetivos as $objetivo) 
    
{
  //echo $objetivo; 
?>      <tr class="success">
            
                <td colspan="1"><?= $objetivo['nombre']?></td>
                <td colspan="1"><?= $objetivo['descripcion']?></td>
                <td colspan="2"><?= " "?></td>
                
                <td colspan="14"><?php foreach ($datosdireciones as $direccion)
                    {
                        if($objetivo['responsable'] == $direccion['id'])
                        {
                         echo   $direccion['nombre'];
                        }
                    }
                    ?>  
                </td>
            
        </tr>
  <?php  

foreach ($datosIndicadores as $indicador)
{
    if($indicador['objetivoid'] == $objetivo['id'])
    {
        ?>
        <tr class="warning">
                <td colspan="1"><?= 'Ind. '.$objetivo['orden'].'.'.$indicador['orden']?></td>
                <td colspan="12"><?= $indicador['descripcion']?></td>
                <td colspan="1"><?=$indicador['UM']?></td>
        <?php
      foreach ($datostope as $tope)
      {
          if($indicador['topeid']==$tope['id'])
          {
              foreach ($datossentido as $sentido)
              {
                  if($tope['idsentido']==$sentido['id'])
                  {
              ?>
                 <td colspan="4"><?=$sentido['sentido'].$tope['valor']?></td>
             <?php 
                    }
                  }
              }
        }
        ?> 
          </tr>
      
              <?php
             foreach ($datosevaluacionIndicador as $evaluacionindicador)
             {
                 if($indicador['id'] == $evaluacionindicador['indicadores_gestionid'])
                 {
              ?>    
        <tr>   
           
                <td colspan="1">
                    <?php
                        echo 'Valor Actual :'.$evaluacionindicador['valor'];
           
                    ?>
                </td>
                <td colspan="9">
         
                
                        <?php
                        foreach ($datosuser as $user)
                        {
                            if($evaluacionindicador['userid']==$user['id'])
                                {
                                    echo 'Informado por: '.$user['username'];
                                }
                        }
                        ?>
                </td >
          
                <td colspan = "8">
        
                    <?php
                        foreach ($datosestado as $estado)
                            {
                                if($evaluacionindicador['estado_cumplimientoid']==$estado['id'])
                                {
                                echo 'Estado de la Información: '.$estado['estado'];
                                }
                          }
                       ?>
                
                </td>
       </tr>
       <tr>
                <td colspan = "18">
                    <?php
                        echo $evaluacionindicador['observaciones'];
                    ?>
                </td>
       </tr>
        <?php 
        if($evaluacionindicador['anexo'] == 1 && yii\helpers\ArrayHelper::keyExists($evaluacionindicador['id'], $anexoindicadorid, false))
        {?>
       <tr>
           <td colspan="18" class="warning"> 
               Anexo del Indicador <?= 'Ind. '.$objetivo['orden'].'.'.$indicador['orden']?> 
           </td>
       </tr>
       <tr>
           <td colspan="18"> 
             <?php
                echo $anexoindicadorid[$evaluacionindicador['id']];
             
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
                 
              ?>
           <?php
   
    }
}
}?>
        
    </tbody>
</table>






