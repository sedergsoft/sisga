<?php
$this->title = Yii::t('app', 'Analisis de ventas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
use miloschuman\highcharts\Highcharts;
?>

<div style="display: none">
    <?php
    echo Highcharts::widget([
        'scripts'=>[
            'highcharts-more',
            'module/exporting',
            'theme/grid',
            'highcharts-3d',
            'module/drilldown'
        ]
    ])
    ?>
    
</div>
<div id="chart1"></div>
<?php
$sql = 'SELECT DISTINCT MONTH(ventas.fecha) as fecha, ventas.vreal, empresa.nombre FROM ventas, empresa  ORDER BY ventas.fecha';
   $sqlempresa = 'SELECT DISTINCT empresa.nombre, MONTH(ventas.fecha) as fecha FROM empresa, ventas';
   $rawData = Yii::$app->db->createCommand($sql)->queryAll();
   $rawDataempresa = Yii::$app->db->createCommand($sqlempresa)->queryAll();
   if($rawData)
   {
   $evaluado_data = [];
   foreach ($rawData as $data)
   { 
      $evaluado_data[] = [
         'name' => $data ['nombre'], 
         'y' => $data ['vreal'] * 1, 
         'drilldown' => $data ['fecha']
              ];       
      $evaluado = json_encode($evaluado_data);      
   }
   }
   else
   {
      $evaluado = "false";  
   }
      if($rawDataempresa)
   {
   $empresa_data = [];
   foreach ($rawData as $data)
   { 
      $empresa_data[] = [
         'name' => $data ['nombre'], 
          'y' => $data ['fecha'] * 1, 
          'drilldown' => $data ['nombre']];      
      $empresa = json_encode($empresa_data);      
   }
   }
   else
   {
      $empresa = "false"; 
   }

?>

<?php
$this->registerJs("$(function() {
      $('#chart1').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Comportamiento de las ventas' 
         },
      xAxis: {
        type:category
         title: {
             text: 'Periodo',             
             },
         },
      yAxis: { 
          allowDecimals: true,
          title: {
             text: 'Temperature (C)'
             
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
        name:Empresas,
        colorByPoint:true
        data:$empresa
            }
            ]
      
      });
      });");

?>
