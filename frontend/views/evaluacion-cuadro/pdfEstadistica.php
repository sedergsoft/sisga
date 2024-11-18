<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

 $asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>


<div>
    <img class="pull-left"  src=<?php echo $baseUrl."/"."images/logomincin1.png" ?> style="display:inline; horizontal-align: top; height:50px;"/>
    
</div>


<div> 
    
    <h4 align = "center">Modelo estadístico del Proceso de Evaluación del año    </h4>
    
    <table border="1" class=" panel panel-info kv-grid-table table table-bordered table-striped kv-table-wrap">
        <thead>
           
            <tr>
                <th class="info"colspan="3"><center><h2 class="panel-title" >Modelo estadístico del Proceso de Evaluación del año </h2></center> </th>
            </tr>
            <tr>
                <th>Indicador</th>
                <th>Cantidad</th>
                <th> % </th>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>Total de cargos de Cuadro</td>
                <td><?php print_r($modelplantilla['cant_cuadros']);?></td>
                <td></td>
            </tr> 
             <tr>
                <td>Cargos de Cuadros Cubiertos</td>
                <td><?php print_r($modelplantilla['cuadros_cubierta']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$modelplantilla['cuadros_cubierta']));?></td>
            </tr> 
             <tr>
                <td>Cuadros a evaluar</td>
                <td><?php print_r($modelplantilla['cuadros_cubierta']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$modelplantilla['cuadros_cubierta']));?></td>
            </tr> 
             <tr>
                <td>Cuadros Evaluados</td>
                <td><?php print_r($modelplantilla['cuadros_cubierta']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$modelplantilla['cuadros_cubierta']));?></td>
            </tr> 
            
            
            <tr>
                 <th class="warning"colspan="3"><strong><h2 class="panel-title" >Total de cuadros por resultado de Evaluación </h2></strong> </th>
            </tr>
            <?php foreach ($rawcalificacion as $key=>$datos)
            {
     ?>
     
 
            <tr>
                <td><?php print_r($datos['indicador']);?></td>
                <td><?php print_r($datos['total']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$datos['total']));?></td>
            </tr>
         <?php           }           
     ?>   
             <tr>
                 <th class="warning"colspan="3"><strong><h2 class="panel-title" >Proyecciones de los cuadros derivadas de los resultados de la evaluación </h2></strong> </th>
            </tr>
            <?php foreach ($rawProyeccion as $key=>$datos)
            {
     ?>
     
 
            <tr>
                <td><?php print_r($datos['indicador']);?></td>
                <td><?php print_r($datos['total']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$datos['total']));?></td>
            </tr>
         <?php           }           
     ?>   
             <tr>
                 <th class="warning"colspan="3"><strong><h2  class="panel-title">De ellos </h2></strong> </th>
            </tr>
            <?php foreach ($rawmovimiento as $key=>$datos)
            {
     ?>
     
 
            <tr>
                <td><?php print_r('Cuadros a '.$datos['indicador']);?></td>
                <td><?php print_r($datos['total']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$datos['total']));?></td>
            </tr>
         <?php           }           
     ?>   
            <?php foreach ($reservaData as $key=>$datos)
            {
     ?>
     
 
            <tr>
                <td><?php print_r('Total de Cuadros ('.$datos['indicador'].')');?></td>
                <td><?php print_r($datos['total']);?></td>
                <td><?php print_r(\frontend\controllers\SiteController::Porciento($modelplantilla['cant_cuadros'],$datos['total']));?></td>
            </tr>
         <?php           }           
     ?>   
            
        </tbody>
    </table>
    
 </div> 
    

