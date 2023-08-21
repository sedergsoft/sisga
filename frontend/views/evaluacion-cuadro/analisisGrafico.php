<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Analisis Gráfico Estadistico del Proceso de Evaluación');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="evaluacion-cuadro-index">


   

<div>
      
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
            
            <div class="col-lg-6 col col-sm-6">
               <p>
                   <div id = "chart1" > </div>
               </p>                
            </div>
            
            <div class="col-lg-6 col-sm-6">
               <p>
                   <div id = "chart2" > </div>
               </p>                
            </div>
                     
        </div>
        
     </div>  
         
    <div class="body-content">

        <div class="row">
            
            <div class="col-lg-6 col-sm-6">
               <p>
                   <div id = "chart3" > </div>
               </p>                
            </div>
            
            <div class="col-lg-6 col-sm-6">
               <p>
                   <div id = "chart4" > </div>
               </p>                
            </div>
                     
        </div>
        
     </div>  
         

     <?php
   $sql = 'SELECT DISTINCT calificacion.calificacion,(SELECT COUNT(evaluacion_cuadro.resultado_evaluacion) FROM evaluacion_cuadro WHERE evaluacion_cuadro.resultado_evaluacion = calificacion.id AND evaluacion_cuadro.ultima = 1) AS total FROM calificacion';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $total_data = [];
   foreach ($rawData as $data)
   { 
      $total_data[] = [
         'name' => $data ['calificacion'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
  ?>
<?php $this->registerJs("$(function() {
      $('#chart1').highcharts({
      chart: {
          type: 'pie'
          },
      title: { 
         text: 'Total de Cuadros Por resultados de evaluación' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Evaluacion',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA Cuadros',
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
                                    
      ],
      });
      });");
?>
    
     <?php
   $sql = 'SELECT DISTINCT tipo_proyeccion.tipo,(SELECT COUNT(proyeccion.tipo_proyeccionid ) FROM evaluacion_cuadro INNER JOIN proyeccion ON evaluacion_cuadro.proyeccionid = proyeccion.id WHERE proyeccion.tipo_proyeccionid = tipo_proyeccion.id AND evaluacion_cuadro.ultima = 1) AS total FROM tipo_proyeccion';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $total_data = [];
   foreach ($rawData as $data)
   { 
      $total_data[] = [
         'name' => $data ['tipo'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
  ?>
<?php $this->registerJs("$(function() {
      $('#chart2').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Proyección de los cuadros derivada de los resultados de la evaluación ' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Evaluacion',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA Cuadros',
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
                                    
      ],
      });
      });");
?>
    
    
    
     <?php
   $sql = 'SELECT DISTINCT tipo_movimiento.tipo_movimiento,(SELECT COUNT(proyeccion.tipo_movimientoid ) FROM evaluacion_cuadro INNER JOIN proyeccion ON evaluacion_cuadro.proyeccionid = proyeccion.id WHERE proyeccion.tipo_movimientoid = tipo_movimiento.id AND evaluacion_cuadro.ultima = 1) AS total FROM tipo_movimiento';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $total_data = [];
   foreach ($rawData as $data)
   { 
      $total_data[] = [
         'name' => $data ['tipo_movimiento'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
  ?>
<?php $this->registerJs("$(function() {
      $('#chart3').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Movimiento de los cuadros derivados de los resulatdos de la evaluacion ' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Evaluacion',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA Cuadros',
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
                                    
      ],
      });
      });");
?>
    
     <?php
   $sql = 'SELECT DISTINCT tipo_reserva.tipo,(SELECT COUNT(reserva.tipo ) FROM evaluacion_cuadro INNER JOIN reserva ON evaluacion_cuadro.reservaid = reserva.id WHERE reserva.tipo = tipo_reserva.id AND evaluacion_cuadro.ultima = 1) AS total FROM tipo_reserva';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   if($rawData)
   {
   $total_data = [];
   foreach ($rawData as $data)
   { 
      $total_data[] = [
         'name' => $data ['tipo'], 'y' => $data ['total'] * 1, 'drilldown' => $data ['total']];      
      $total = json_encode($total_data);      
   }
   }
   else
   {
      $total = "false"; 
   }
  ?>
<?php $this->registerJs("$(function() {
      $('#chart4').highcharts({
      chart: {
          type: 'bar'
          },
      title: { 
         text: 'Proyeción de la Reserva' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Evaluacion',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Cantidad'
             
             },
      },
      credits: {
            text: '© SisGA Cuadros',
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
                                    
      ],
      });
      });");
?>
    
</div>  
    
    
</div>
