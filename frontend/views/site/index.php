<?php
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->title = 'SisGA';
$this->params['tittle'][]= $this->title;
$this->params['desc'][]= "Sistema de Autocontrol";
?>
<div class="site-index">

    <?php
      if(Yii::$app->user->isGuest)
      {?>
         <div class="jumbotron">
       
       

             <div  align ="center">
                  <img src=<?php echo$baseUrl."/uploads/images/Logo_GA_transparente.png" ?> />
                  <p class="lead" style="color: #727272">Sistema de Evaluación de Objetivos.</p>
             </div>

        
        </div>
          
          
     <?php } else{ ?>
  
         
    <?php 
  if(Yii::$app->user->identity->rolid == "2" || Yii::$app->user->identity->rolid == "5") //graficos para presidente y administradores
      {?>
     
    
          <div style="display: none"> 
                    <?php
                      echo Highcharts::widget([
                          
                           'scripts' => [
                               'highcharts-more',                                
                           ]
                          ]);
                      ?>
                        </div>
        
        <div class="body-content">

        <div class="row">
            
            <div class="col-lg-12">
               <p>
                   <div id = "chart1" > </div>
               </p>                
            </div>
            
            <div class="col-lg-12">
               
               <p>
                   <div id = "chart2"> </div>
               </p>             
            </div>
            
            
        </div>
        
         </div>       

    
             
             
   <?php
   $sql = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = direccion.id AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1) AS total FROM criteriomedida, direccion WHERE criteriomedida.direccionid=direccion.id AND direccion.Status = 1';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $evaluado_data = [];
   foreach ($rawData as $data)
   { 
      $evaluado_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false"; 
   }
    $sql1 = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = direccion.id  AND criteriomedida.status = 1) AS total FROM criteriomedida, direccion WHERE criteriomedida.direccionid=direccion.id AND direccion.Status = 1';
   $rawData1 = Yii::$app->db->createCommand($sql1)->queryAll();
   if($rawData1)
   {
   $total_data = [];
   foreach ($rawData1 as $data)
   { 
      $total_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }

  $sqlinformados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = direccion.id AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total,(SELECT COUNT(evaluacion.valor_vreal) FROM evaluacion,criteriomedida WHERE evaluacion.estado = 1 AND evaluacion.actual = 1 AND evaluacion.actual = 1  AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1 and evaluacion.direccionid = direccion.id AND evaluacion.status = 1 AND evaluacion.criteriomedidaid = criteriomedida.id)as informados FROM evaluacion,criteriomedida,direccion WHERE direccion.id = criteriomedida.direccionid AND direccion.Status = 1';
  $rawDatainformados = Yii::$app->db->createCommand($sqlinformados)->queryAll();
   
   if($rawDatainformados)
   {
   $informados_data = [];
   foreach ($rawDatainformados as $data)
   { 
      $informados_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['informados'] * 1, 'drilldown' => $data ['total']];      
      $informados = json_encode($informados_data);      
   }
   }
   else
   {
      $informados = "false"; 
   }
   $sqlcertificados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = direccion.id AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total,(SELECT COUNT(evaluacion.valor_vreal) FROM evaluacion,criteriomedida WHERE evaluacion.estado = 2 AND evaluacion.actual = 1 AND  criteriomedida.evaluado = 1 AND criteriomedida.status = 1 and evaluacion.direccionid = direccion.id AND evaluacion.status = 1 AND evaluacion.criteriomedidaid = criteriomedida.id)as certificados FROM evaluacion,criteriomedida,direccion WHERE direccion.id = criteriomedida.direccionid AND direccion.Status = 1';
  $rawDatacertificados = Yii::$app->db->createCommand($sqlcertificados)->queryAll();
   
   if($rawDatacertificados)
   {
   $certificados_data = [];
   foreach ($rawDatacertificados as $data)
   { 
      $certificados_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['certificados'] * 1, 'drilldown' => $data ['total']];      
      $certificados = json_encode($certificados_data);      
   }
   }
   else
   {
      $certificados = "false"; 
   }
   
  
   ?>

<?php $this->registerJs("$(function() {
      $('#chart2').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Criterios de medida' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $total
      },  
{
        name: 'Evaluados',
           
        data: $evaluado
      },
    
{
        name: 'Informados',
         
        data: $informados
      },      
{
        name: 'Certificados',
         
        data: $certificados
      }                                    
      ],
      });
      });");
?>

<?php
   $sql = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = direccion.id AND indicadores_gestion.status = 1) AS total FROM indicadores_gestion, direccion WHERE indicadores_gestion.direccionid=direccion.id AND direccion.Status = 1';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $total_data = [];
   foreach ($rawData as $data)
   { 
      $total_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
    $sqlevaluado = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = direccion.id and indicadores_gestion.evaluado = 1  AND indicadores_gestion.status = 1) AS evaluado FROM indicadores_gestion, direccion WHERE indicadores_gestion.direccionid=direccion.id AND direccion.Status = 1';
   $rawDataevaluado = Yii::$app->db->createCommand($sqlevaluado)->queryAll();
   if($rawDataevaluado)
   {
   $evaluado_data = [];
   foreach ($rawDataevaluado as $data)
   { 
      $evaluado_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['evaluado'] * 1, 'drilldown' => $data ['evaluado']];      
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false"; 
   }
?>
 <?php
     $sqlinformados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = direccion.id and indicadores_gestion.evaluado = 1  AND indicadores_gestion.status = 1) AS evaluado,(SELECT COUNT(cumplimiento.valor) FROM indicadores_gestion,cumplimiento WHERE indicadores_gestion.direccionid = direccion.id and indicadores_gestion.evaluado = 1 AND cumplimiento.estado_cumplimientoid =1 AND cumplimiento.actual =1 and cumplimiento.status =1 and cumplimiento.indicadores_gestionid = indicadores_gestion.id AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").'  AND indicadores_gestion.status = 1) AS informados FROM indicadores_gestion, direccion WHERE indicadores_gestion.direccionid=direccion.id AND direccion.Status = 1';
   $rawDatainformados = Yii::$app->db->createCommand($sqlinformados)->queryAll();
   
   if($rawDatainformados)
   {
   $informados_data = [];
   foreach ($rawDatainformados as $data)
   { 
      $informados_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['informados'] * 1, 'drilldown' => $data ['informados']];      
      $informados = json_encode($informados_data);      
   }
   }
   else
   {
      $informados = "false"; 
   }
   $sqlcertificados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = direccion.id and indicadores_gestion.evaluado = 1) AS evaluado,(SELECT COUNT(cumplimiento.valor) FROM indicadores_gestion,cumplimiento WHERE indicadores_gestion.direccionid = direccion.id and indicadores_gestion.evaluado = 1 AND cumplimiento.estado_cumplimientoid =2 and cumplimiento.status =1 AND cumplimiento.actual =1 and cumplimiento.indicadores_gestionid = indicadores_gestion.id AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").'  AND indicadores_gestion.status = 1) AS Certiificados FROM indicadores_gestion, direccion WHERE indicadores_gestion.direccionid=direccion.id AND direccion.Status = 1';
    $rawDatacertificados = Yii::$app->db->createCommand($sqlcertificados)->queryAll();
   
   if($rawDatacertificados)
   {
   $certificados_data = [];
   foreach ($rawDatacertificados as $data)
   { 
      $certificados_data[] = [
         'name' => substr($data ['nombre'],14), 'y' => $data ['Certiificados'] * 1, 'drilldown' => $data ['Certiificados']];      
      $certificados = json_encode($certificados_data);      
   }
   }
   else
   {
      $certificados = "false"; 
   }?>
<?php $this->registerJs("$(function() {
      $('#chart1').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Indicadores de Gestión' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $total
      }  ,        
{
        name: 'Evaluados',
           
        data: $evaluado
      },
  
{
        name: 'Informados',
         
        data: $informados
      },      
{
        name: 'Certificados',
         
        data: $certificados
      }                                    
      ],
      });
      });");
?>
    
          
     <?php } ?>
    
    
    <?php 
  if(Yii::$app->user->identity->rolid == "3") //graficos para directores
      {?>
     
    
          <div style="display: none"> 
                    <?php
                      echo Highcharts::widget([
                          
                           'scripts' => [
                               'highcharts-more',                                
                           ]
                          ]);
                      ?>
                        </div>
        
        <div class="body-content">

        <div class="row">
            
            <div class="col-lg-6">
               <p>
                   <div id = "chartindicadores" style="width: 550px; height: 300px; margin: 0 auto"> </div>
               </p>                
            </div>
            
            <div class="col-lg-6">
               
               <p>
                 <div id = "chartcriterios" style="width: 550px; height: 300px; margin: 0 auto"> </div> 
               </p>             
            </div>
            
            
        </div>
        
         </div>       

   
<?php
     $sql = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1' ;
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $evaluado_data = [];
   foreach ($rawData as $data)
   { 
      $evaluado_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false"; 
   }
  $sql1 = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND direccion.Status = 1' ;
   $rawData1 = Yii::$app->db->createCommand($sql1)->queryAll();
   if($rawData1)
   {
   $total_data = [];
   foreach ($rawData1 as $data)
   { 
      $total_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
   
     $sqlinformados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total,(SELECT COUNT(evaluacion.valor_vreal) FROM evaluacion,criteriomedida WHERE evaluacion.estado = 1 AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1 and evaluacion.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND evaluacion.status = 1 AND evaluacion.criteriomedidaid = criteriomedida.id)as informados FROM evaluacion,direccion WHERE direccion.id = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND direccion.Status = 1' ;
   $rawDatainformados = Yii::$app->db->createCommand($sqlinformados)->queryAll();
   
   if($rawDatainformados)
   {
   $informados_data = [];
   foreach ($rawDatainformados as $data)
   { 
      $informados_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['informados'] * 1, 'drilldown' => $data ['total']];      
      $informados = json_encode($informados_data);      
   }
   }
   else
   {
      $informados = "false"; 
   }
   $sqlcertificados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total,(SELECT COUNT(evaluacion.valor_vreal) FROM evaluacion,criteriomedida WHERE evaluacion.estado = 2 AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1 and evaluacion.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND evaluacion.status = 1 AND evaluacion.criteriomedidaid = criteriomedida.id)as Certiificados FROM evaluacion,direccion WHERE direccion.id = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND direccion.Status = 1' ;
    $rawDatacertificados = Yii::$app->db->createCommand($sqlcertificados)->queryAll();
   
   if($rawDatacertificados)
   {
   $certificados_data = [];
   foreach ($rawDatacertificados as $data)
   { 
      $certificados_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['Certiificados'] * 1, 'drilldown' => $data ['total']];      
      $certificados = json_encode($certificados_data);      
   }
   }
   else
   {
      $certificados = "false"; 
   }
   
?>
<?php $this->registerJs("$(function() {
      $('#chartcriterios').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Criterios de Medida' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $total
      },
{
        name: 'Evaluados',
           
        data: $evaluado
      },

{
        name: 'Informados',
         
        data: $informados
      },       
       {
        name: 'Certificados',
         
        data: $certificados
      }       
              
      ],
      });
      });");
?>
    <?php $sql = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1 and indicadores_gestion.evaluado = 1)as evaluado FROM cumplimiento,direccion WHERE direccion.id = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").' AND direccion.Status = 1' ;
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $evaluado_data = [];
   foreach ($rawData as $data)
   { 
      $evaluado_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['evaluado'] * 1, 'drilldown' => $data ['evaluado']];      
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false"; 
   }
  $sql1 =  'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid ='.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1)as total FROM direccion WHERE direccion.id = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id;
   $rawData1 = Yii::$app->db->createCommand($sql1)->queryAll();
   if($rawData1)
   {
   $total_data = [];
   foreach ($rawData1 as $data)
   { 
      $total_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
   
     //$sqlinformados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1)as total,(SELECT COUNT(cumplimiento.valor) FROM cumplimiento,indicadores_gestion WHERE indicadores_gestion.evaluado = 1 AND indicadores_gestion.status = 1 AND indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' and cumplimiento.status = 1  and cumplimiento.estado_cumplimientoid = 1 AND cumplimiento.indicadores_gestionid = indicadores_gestion.id AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").' )as informados FROM cumplimiento,direccion WHERE direccion.id = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id;
     $sqlinformados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' and indicadores_gestion.evaluado = 1) AS total,(SELECT COUNT(cumplimiento.valor) FROM indicadores_gestion,cumplimiento WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' and indicadores_gestion.evaluado = 1 AND cumplimiento.estado_cumplimientoid =1 and cumplimiento.status =1 AND cumplimiento.actual =1 and cumplimiento.indicadores_gestionid = indicadores_gestion.id AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").') AS informados FROM indicadores_gestion, direccion WHERE direccion.id ='.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1';
   $rawDatainformados = Yii::$app->db->createCommand($sqlinformados)->queryAll();
   
   if($rawDatainformados)
   {
   $informados_data = [];
   foreach ($rawDatainformados as $data)
   { 
      $informados_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['informados'] * 1, 'drilldown' => $data ['total']];      
      $informados = json_encode($informados_data);      
   }
   }
   else
   {
      $informados = "false"; 
   }
   //$sqlcertificados = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1)as total,(SELECT COUNT(cumplimiento.valor) FROM cumplimiento,indicadores_gestion WHERE indicadores_gestion.evaluado = 1 AND indicadores_gestion.status = 1 AND indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' and cumplimiento.status = 1  and cumplimiento.estado_cumplimientoid = 2 AND cumplimiento.indicadores_gestionid = indicadores_gestion.id AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").')as certificados FROM cumplimiento,direccion WHERE direccion.id = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id;
   $sqlcertificados =   'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' and indicadores_gestion.evaluado = 1) AS evaluado,(SELECT COUNT(cumplimiento.valor) FROM indicadores_gestion,cumplimiento WHERE indicadores_gestion.direccionid = '.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' and indicadores_gestion.evaluado = 1 AND cumplimiento.estado_cumplimientoid =2 and cumplimiento.status =1 AND cumplimiento.actual =1 and cumplimiento.indicadores_gestionid = indicadores_gestion.id AND YEAR(cumplimiento.fecha) = '.date("Y").' AND MONTH(cumplimiento.fecha) = '.date("m").') AS certificados FROM indicadores_gestion, direccion WHERE direccion.id ='.frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1';
    $rawDatacertificados = Yii::$app->db->createCommand($sqlcertificados)->queryAll();
   
   if($rawDatacertificados)
   {
   $certificados_data = [];
   foreach ($rawDatacertificados as $data)
   { 
      $certificados_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['certificados'] * 1, 'drilldown' => $data ['certificados']];      
      $certificados = json_encode($certificados_data);      
   }
   }
   else
   {
      $certificados = "false"; 
   }
   
?>
<?php $this->registerJs("$(function() {
      $('#chartindicadores').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Indicadores de Gestión' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $total
      },
{
        name: 'Evaluados',
           
        data: $evaluado
      },

{
        name: 'Informados',
         
        data: $informados
      },       
       {
        name: 'Certificados',
         
        data: $certificados
      }       
              
      ],
      });
      });");?>
          
     <?php } 
     
  if(Yii::$app->user->identity->rolid == "4") //grafico para especialistas
      {?>
     
    
          <div style="display: none"> 
                    <?php
                      echo Highcharts::widget([
                          
                           'scripts' => [
                               'highcharts-more',                                
                           ]
                          ]);
                      ?>
                        </div>
        
        <div class="body-content">

        <div class="row">
            
            <div class="col-lg-6">
               <p>
                   <div id = "indicadores" style="width: 550px; height: 300px; margin: 0 auto"> </div>
               </p>                
            </div>
            
            <div class="col-lg-6">
               
               <p>
                 <div id = "criterios" style="width: 550px; height: 300px; margin: 0 auto"> </div>
               </p>             
            </div>
            
            
        </div>
        
         </div>       

 

<?php
     $sql = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id ;
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $evaluado_data = [];
   foreach ($rawData as $data)
   { 
      $evaluado_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false"; 
   }
  $sql1 = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id ;
   $rawData1 = Yii::$app->db->createCommand($sql1)->queryAll();
   if($rawData1)
   {
   $total_data = [];
   foreach ($rawData1 as $data)
   { 
      $total_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
   
 $sql5indicadores = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1 AND indicadores_gestion.evaluado = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id ;
   $rawData5indicadores = Yii::$app->db->createCommand($sql5indicadores)->queryAll();
   if($rawData5indicadores)
   {
   $evaluado_data5indicadores = [];
   foreach ($rawData5indicadores as $data)
   { 
      $evaluado_data5indicadores[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $evaluado5indicadores = json_encode($evaluado_data5indicadores);      
   }
   }
   else
   {
      $evaluado5indicadores = "false"; 
   }
  
  $sql1indicadores = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id ;
   $rawData1indicadores = Yii::$app->db->createCommand($sql1indicadores)->queryAll();
   if($rawData1indicadores)
   {
   $total_dataindicadores = [];
   foreach ($rawData1indicadores as $data)
   { 
      $total_dataindicadores[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $totalindicadores = json_encode($total_dataindicadores);      
   }
   }
   else
   {
      $totalindicadores = "false"; 
   }
   
 
   
?>
<?php $this->registerJs("$(function() {
      $('#indicadores').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Indicadores de Gestión' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $totalindicadores
      },
      {
        name: 'Evaluados',
           
        data: $evaluado5indicadores
      },
     
          
              
      ],
      });
      });");

$this->registerJs("$(function() {
      $('#criterios').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Criterios de Medida' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $total
      },
      {
        name: 'Evaluados',
           
        data: $evaluado
      },
     
          
              
      ],
      });
      });");
?>
    
          
     <?php } 
  
     
      if(Yii::$app->user->identity->rolid == "6") //grafico para gestor de Cuadro
      {?>
     
    
          <div style="display: none"> 
                    <?php
                      echo Highcharts::widget([
                          
                           'scripts' => [
                               'highcharts-more',                                
                           ]
                          ]);
                      ?>
                        </div>
        
        <div class="body-content">

        <div class="row">
            
            <div class="col-lg-6">
               <p>
                   <div id = "indicadores" style="width: 550px; height: 300px; margin: 0 auto"> </div>
               </p>                
            </div>
            
            <div class="col-lg-6">
               
               <p>
                 <div id = "criterios" style="width: 550px; height: 300px; margin: 0 auto"> </div>
               </p>             
            </div>
            
            
        </div>
        
         </div>       

 

<?php
     $sql = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.evaluado = 1 AND criteriomedida.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1' ;
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $evaluado_data = [];
   foreach ($rawData as $data)
   { 
      $evaluado_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false"; 
   }
  $sql1 = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(criteriomedida.evaluado) FROM criteriomedida WHERE criteriomedida.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND criteriomedida.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1' ;
   $rawData1 = Yii::$app->db->createCommand($sql1)->queryAll();
   if($rawData1)
   {
   $total_data = [];
   foreach ($rawData1 as $data)
   { 
      $total_data[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
   
 $sql5indicadores = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1 AND indicadores_gestion.evaluado = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1' ;
   $rawData5indicadores = Yii::$app->db->createCommand($sql5indicadores)->queryAll();
   if($rawData5indicadores)
   {
   $evaluado_data5indicadores = [];
   foreach ($rawData5indicadores as $data)
   { 
      $evaluado_data5indicadores[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $evaluado5indicadores = json_encode($evaluado_data5indicadores);      
   }
   }
   else
   {
      $evaluado5indicadores = "false"; 
   }
  
  $sql1indicadores = 'SELECT DISTINCT direccion.nombre,(SELECT COUNT(indicadores_gestion.evaluado) FROM indicadores_gestion WHERE indicadores_gestion.direccionid = '. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id.' AND indicadores_gestion.status = 1)as total FROM direccion WHERE direccion.id ='. frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->id. ' AND direccion.Status = 1' ;
   $rawData1indicadores = Yii::$app->db->createCommand($sql1indicadores)->queryAll();
   if($rawData1indicadores)
   {
   $total_dataindicadores = [];
   foreach ($rawData1indicadores as $data)
   { 
      $total_dataindicadores[] = [
         'name' => $data ['nombre'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $totalindicadores = json_encode($total_dataindicadores);      
   }
   }
   else
   {
      $totalindicadores = "false"; 
   }
   
 
   
?>
<?php $this->registerJs("$(function() {
      $('#indicadores').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Indicadores de Gestión' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $totalindicadores
      },
      {
        name: 'Evaluados',
           
        data: $evaluado5indicadores
      },
     
          
              
      ],
      });
      });");

$this->registerJs("$(function() {
      $('#criterios').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Criterios de Medida' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Direcciones',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA',
            href: ''
            },
      legend: {
         layout: 'verticaal',
         align:'right',
         verticalAlign:'middle',
         borderWidth:0
         },
      plotOptions: {
         series: {
            borderWidth: 0,
            dataLabels: {
               enabled: true
               }  
         }
      },
      series: [
{
        name: 'Total',
         
        data: $total
      },
      {
        name: 'Evaluados',
           
        data: $evaluado
      },
     
          
              
      ],
      });
      });");
?>
    
          
     <?php }
     }
     ?>
      
  </div>      
        



