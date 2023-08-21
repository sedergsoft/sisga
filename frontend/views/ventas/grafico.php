<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;
use kartik\popover\PopoverX;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comportamiento de Ventas Netas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="ventas-index">
    
    <div>
           <hr>
    <p>
            <?php  PopoverX::begin([
    'placement' => PopoverX::ALIGN_AUTO,
    'toggleButton' => ['label'=>'<i class="glyphicon glyphicon-calendar"></i> Selecionar mes', 'class'=>'btn btn-success'],
    'header' => '<i class="glyphicon glyphicon-calendar"></i> Selecione el mes a mostrar',
    'footer' => Html::button('<i class="glyphicon glyphicon-ok"></i>', [
            'class' => 'btn btn-sm btn-primary', 
            'onclick' => '$("#kv-login-form").trigger("submit")',
           'value'=> Url::to(['ventas/selecionarmes'])
        ]) 
]);
// form with an id used for action buttons in footer
$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false],'action'=>"/sisga/frontend/web/index.php/ventas/selecionarmes", 'options' => ['id'=>'kv-login-form']]);
 echo Select2::widget([
    'name' => 'Mes',
    'data' =>  [
                1 => 'enero', 
                2 => 'febrero',
              3 => 'marzo', 
                4 => 'abril',
              5 => 'mayo', 
                6 => 'junio',
              7 => 'julio', 
                8 => 'agosto',
              9 => 'septiembre', 
                10 => 'octubre',
              11 => 'noviembre', 
                12 => 'diciembre',
              ],
     'initValueText'=> date('m'),
   // 'options' => ['placeholder' => 'Seleciona el mes a mostrar ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?>
 
        <br>
        
 <?php echo \kartik\touchspin\TouchSpin::widget([
    'name' => 'Año',
          
             'options' =>[
                            'class'=>'input-sm',
                            //'placeholder'=>'2019',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'Año :',
                                    'initval'=> date('Y'),
                                    'min'=>2018,
                                    'max'=>2050,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
        
    ]      
]);
//echo $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter password...']);
ActiveForm::end();
PopoverX::end();
?>
    </p>
    <hr>

        
    </div>
    
   
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
     
   $sqlpinar = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=11 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatapinar = Yii::$app->db->createCommand($sqlpinar)->queryAll();
  if($rawDatapinar)
   {
   $pinar_data = [];
   foreach ($rawDatapinar as $data)
   { 
      $pinar_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $pinar = json_encode($pinar_data);      
   }
   }
   else
   {
      $pinar = "false"; 
   }
   $sqlart = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=12 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDataart = Yii::$app->db->createCommand($sqlart)->queryAll();
  if($rawDataart)
   {
   $art_data = [];
   foreach ($rawDataart as $data)
   { 
      $art_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $art = json_encode($art_data);      
   }
   }
   else
   {
      $art = "false"; 
   }
   $sqlmay = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=13 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatamay = Yii::$app->db->createCommand($sqlmay)->queryAll();
  if($rawDatamay)
   {
   $may_data = [];
   foreach ($rawDatamay as $data)
   { 
      $may_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $may = json_encode($may_data);      
   }
   }
   else
   {
      $may = "false"; 
   }
   $sqllah = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=14 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatalah = Yii::$app->db->createCommand($sqllah)->queryAll();
  if($rawDatalah)
   {
   $lah_data = [];
   foreach ($rawDatalah as $data)
   { 
      $lah_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $lah = json_encode($lah_data);      
   }
   }
   else
   {
      $lah = "false"; 
   }
   $sqlmat = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=15 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatamat = Yii::$app->db->createCommand($sqlmat)->queryAll();
  if($rawDatamat)
   {
   $mat_data = [];
   foreach ($rawDatamat as $data)
   { 
      $mat_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $mat = json_encode($mat_data);      
   }
   }
   else
   {
      $mat = "false"; 
   }
   $sqlcie = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=16 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatacie = Yii::$app->db->createCommand($sqlcie)->queryAll();
  if($rawDatacie)
   {
   $cie_data = [];
   foreach ($rawDatacie as $data)
   { 
      $cie_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $cie = json_encode($cie_data);      
   }
   }
   else
   {
      $cie = "false"; 
   }
   $sqlvil = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=17 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatavil = Yii::$app->db->createCommand($sqlvil)->queryAll();
  if($rawDatavil)
   {
   $vil_data = [];
   foreach ($rawDatavil as $data)
   { 
      $vil_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $vil = json_encode($vil_data);      
   }
   }
   else
   {
      $vil = "false"; 
   }
   $sqlsant = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=18 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatasant = Yii::$app->db->createCommand($sqlsant)->queryAll();
  if($rawDatasant)
   {
   $sant_data = [];
   foreach ($rawDatasant as $data)
   { 
      $sant_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $sant = json_encode($sant_data);      
   }
   }
   else
   {
      $sant = "false"; 
   }
   $sqlcieg = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=19 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatacieg = Yii::$app->db->createCommand($sqlcieg)->queryAll();
  if($rawDatacieg)
   {
   $cieg_data = [];
   foreach ($rawDatacieg as $data)
   { 
      $cieg_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $cieg = json_encode($cieg_data);      
   }
   }
   else
   {
      $cieg = "false"; 
   }
   $sqlcam = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=20 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatacam = Yii::$app->db->createCommand($sqlcam)->queryAll();
  if($rawDatacam)
   {
   $cam_data = [];
   foreach ($rawDatacam as $data)
   { 
      $cam_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $cam = json_encode($cam_data);      
   }
   }
   else
   {
      $cam = "false"; 
   }
   $sqllat = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=21 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatalat = Yii::$app->db->createCommand($sqllat)->queryAll();
  if($rawDatalat)
   {
   $lat_data = [];
   foreach ($rawDatalat as $data)
   { 
      $lat_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $lat = json_encode($lat_data);      
   }
   }
   else
   {
      $lat = "false"; 
   }
   $sqlhol = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=23 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatahol = Yii::$app->db->createCommand($sqlhol)->queryAll();
  if($rawDatahol)
   {
   $hol_data = [];
   foreach ($rawDatahol as $data)
   { 
      $hol_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $hol = json_encode($hol_data);      
   }
   }
   else
   {
      $hol = "false"; 
   }
   $sqlgra = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=23 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatagra = Yii::$app->db->createCommand($sqlgra)->queryAll();
  if($rawDatagra)
   {
   $gra_data = [];
   foreach ($rawDatagra as $data)
   { 
      $gra_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $gra = json_encode($gra_data);      
   }
   }
   else
   {
      $gra = "false"; 
   }
   $sqlsan = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=24 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatasan = Yii::$app->db->createCommand($sqlsan)->queryAll();
  if($rawDatasan)
   {
   $san_data = [];
   foreach ($rawDatasan as $data)
   { 
      $san_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $san = json_encode($san_data);      
   }
   }
   else
   {
      $san = "false"; 
   }
   $sqlgua = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=25 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatagua = Yii::$app->db->createCommand($sqlgua)->queryAll();
  if($rawDatagua)
   {
   $gua_data = [];
   foreach ($rawDatagua as $data)
   { 
      $gua_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $gua = json_encode($gua_data);      
   }
   }
   else
   {
      $gua = "false"; 
   }
   $sqlisl = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=26 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDataisl = Yii::$app->db->createCommand($sqlisl)->queryAll();
  if($rawDataisl)
   {
   $isl_data = [];
   foreach ($rawDataisl as $data)
   { 
      $isl_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $isl = json_encode($isl_data);      
   }
   }
   else
   {
      $isl = "false"; 
   }
   $sqlasg = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=27 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDataasg = Yii::$app->db->createCommand($sqlasg)->queryAll();
  if($rawDataasg)
   {
   $asg_data = [];
   foreach ($rawDataasg as $data)
   { 
      $asg_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $asg = json_encode($asg_data);      
   }
   }
   else
   {
      $asg = "false"; 
   }
   $sqltcf = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=28 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDatatcf = Yii::$app->db->createCommand($sqltcf)->queryAll();
  if($rawDatatcf)
   {
   $tcf_data = [];
   foreach ($rawDatatcf as $data)
   { 
      $tcf_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $tcf = json_encode($tcf_data);      
   }
   }
   else
   {
      $tcf = "false"; 
   }
   $sqlenf = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=29 AND ventas.tipo_ventaid = 2      order by fecha  DESC    ';
   $rawDataenf = Yii::$app->db->createCommand($sqlenf)->queryAll();
  if($rawDataenf)
   {
   $enf_data = [];
   foreach ($rawDataenf as $data)
   { 
      $enf_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $enf = json_encode($enf_data);      
   }
   }
   else
   {
      $enf = "false"; 
   }
   /*$sqlemmp = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=31 AND ventas.tipo_ventaid = 2     ';
   $rawDataemmp = Yii::$app->db->createCommand($sqlemmp)->queryAll();
  if($rawDataemmp)
   {
   $emmp_data = [];
   foreach ($rawDataemmp as $data)
   { 
      $emmp_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $emmp = json_encode($emmp_data);      
   }
   }
   else
   {
      $emmp = "false"; 
   }
   $sqlunal = 'SELECT DISTINCT ventas.vreal, empresa.nombre,empresa.id, tipo_venta.tipo_venta,MONTH(ventas.fecha) as fecha FROM ventas, empresa,tipo_venta WHERE empresa.id = ventas.empresaid and ventas.empresaid=31 AND ventas.tipo_ventaid = 2     ';
   $rawDataunal = Yii::$app->db->createCommand($sqlunal)->queryAll();
  if($rawDataunal)
   {
   $unal_data = [];
   foreach ($rawDataunal as $data)
   { 
      $unal_data[] = [
         'name' => Yii::$app->formatter->asMont($data ['fecha']), 
          'y' => $data ['vreal'] * 1, 
          'drilldown' => $data ['vreal']];      
      $unal = json_encode($unal_data);      
   }
   }
   else
   {
      $unal = "false"; 
   }*/
   ?>

<?php $this->registerJs("$(function() {
      $('#chart2').highcharts({
      chart: {
          type: 'column'
          },
      title: { 
         text: 'Comportamiento de las ventas Netas' 
         },
      xAxis: {
         type: 'category',
         title: {
             text: 'Periodo',             
             },
         },
      yAxis: {
          allowDecimals: false,
          title: {
             text: 'Empresa'
             
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
      series:[
        {
        name: 'Pinar del Rio',
         
        data: $pinar
      }, 
        {
        name: 'Artemisa',
         
        data: $art
      }, 
        {
        name: 'Mayabeque',
         
        data: $may
      }, 
        {
        name: 'La Habana',
         
        data: $lah
      }, 
        {
        name: 'Matanzas',
         
        data: $mat
      }, 
        {
        name: 'Cienfuegos',
         
        data: $cie
      }, 
        {
        name: 'Villa Clara',
         
        data: $vil
      }, 
        {
        name: 'Santis Spiritus',
         
        data: $sant
      }, 
        {
        name: 'Ciego de Avila',
         
        data: $cieg
      }, 
        {
        name: 'Camaguey',
         
        data: $cam
      }, 
        {
        name: 'Las Tunas',
         
        data: $lat
      }, 
        {
        name: 'Holguin',
         
        data: $hol
      }, 
        {
        name: 'Granma',
         
        data: $gra
      }, 
        {
        name: 'Santiago de Cuba',
         
        data: $san
      }, 
        {
        name: 'Guantanamo',
         
        data: $gua
      }, 
        {
        name: 'La Isla',
         
        data: $isl
      }, 
        {
        name: 'ASEGEM',
         
        data: $asg
      }, 
        {
        name: 'TCFCS',
         
        data: $tcf
      }, 
        {
        name: 'ENFRIGO',
         
        data: $enf
      }, 
       
      ],

      });
      });");

 /*{
        name: 'EMMP',
         
        data: $emmp
      }, 
        {
        name: 'UNAL',
         
        data: $unal
      }, */
?>
</div>
