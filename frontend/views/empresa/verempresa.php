<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ImpuestoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Información sobre Empresas : '. $empresa->nombre);
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>

<hr>
<p> Mostrar empresa </p>
<div class="empresa-form">

    <?php $form = ActiveForm::begin(['action'=>"/sisga/frontend/web/index.php/empresa/verinfoempresa"]); ?>

    <?= $form->field($model, 'nombre')->widget(Select2::classname(), [
    'data' =>ArrayHelper::map(frontend\models\Empresa::find()/*->where([])*/->orderBy('id')->asArray()->all(), 'id', 'nombre'),
    'options' => ['placeholder' => 'Seleciona la empresa a mostrar ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);/*?>

    <?= $form->field($model, 'tegnologia_logisticaid')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Mostrar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<hr>



<div class="impuesto-index">

   
    <div>
    <?= GridView::widget([
        'dataProvider' => $dataProviderimpuesto,
    'filterModel' => $searchModelimpuesto,
        'caption'=>'Cumplimiento de los Impuestos',
   

  //  'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'success', 'heading'=>'Cumplimiento de los Impuestos'],
   'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' =>  'Cumplimiento de los Impuestos ('.$empresa->nombre.')',
                    ]], 
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],

        //'id',
        [
        
     
        'width'=>'305px',
            'attribute'=>'empresaid',
         'label'=>'Empresa',
            'value'=>function ($model, $key, $index, $widget) { 
                return $model->empresa->nombre;
            },
           'group'=>true,  // enable grouping
         ], 
                    
             /*         [
               'attribute'=>'fecha',
             ///'label'=>'Impuestos por la venta al 35 % Planeado',
               //'format'=>['decimal', 2],  
                'width'=>'150px',
            //'hAlign'=>'right',           
              ],*/
                    [
               'attribute'=>'venta35_plan',
             'label'=>'Impuestos por la venta al 35 % Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                         [
               'attribute'=>'ventas35_vreal',
             'label'=>'Impuestos por la venta al 35 % Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                               [
               'attribute'=>'ventas2_plan',
             'label'=>'Impuesto de ventas 2% Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                             [
               'attribute'=>'ventas2_vreal',
             'label'=>'Impuesto de ventas 2% Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                   [
               'attribute'=>'especial17_real2',
             'label'=>'Impuesto especial al 17% Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                           [
               'attribute'=>'especial17_vreal',
             'label'=>'Impuesto especial al 17% Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                           [
               'attribute'=>'recuperacion_plan',
             'label'=>'Importe de recuperación al 24% Planeado  ',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                              [
               'attribute'=>'recupercion_vreal',
             'label'=>'Importe de recuperación al 24% Real  ',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                             [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
           
            
          
           
        ],
    ]); ?>
</div>
    <div >   


    <?= GridView::widget([
          'dataProvider' => $dataProvidercapital,
        'filterModel' => $searchModelcapital,
        'showPageSummary'=>true,
        
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Análisis del Capital de Trabajo (Periodo '.$periodocapital. ')'],
       'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' =>  'Análisis del Capital de Trabajo (Periodo '.$periodocapital. ')',
                    ]], 
        'caption'=>'Análisis del Capital de Trabajo (Periodo '.$periodocapital. ')',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
            'group'=>true,  // enable grouping
             ],
                                     [
               'attribute'=>'activo_circulante',
             'label'=>'Activo Circulante',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ],  
                                              [
               'attribute'=>'pasivo_circulante',
             'label'=>'Pasivo Circulante',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
                                                  ],  
                           [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Cap/Trabajo',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(2, $p) - $widget->col(3, $p) ;
           
                  },
             'format'=>['decimal', 2], 
             'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
            ], 
                                [
               'attribute'=>'Suma',
             'label'=>'Suma',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
                   'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
                                    ],
            
                               [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Cap/Trabajo Cobrando los Litigios',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(4, $p) + $widget->col(5, $p) ;
           
                  },
             'format'=>['decimal', 2], 
             'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
            ],
                           [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Cap/Trab Nec',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(3, $p) / 2 ;
           
                  },
             'format'=>['decimal', 2], 
             'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
            ],
                                            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Deficit o Super Avit de Cap/Trabajo',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(6, $p) - $widget->col(7, $p) ;
           
                  },
             'format'=>['decimal', 2], 
             'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
            ],
                                               [
               'attribute'=>'creditos_bancarios',
             'label'=>'Creditos bancarios',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
                   'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  
                                                   ],                
                          
                                               [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
            
            //'fecha',

           
        ],
    ]); ?>
</div>

    <div> 

    <?= GridView::widget([
          'dataProvider' => $dataProviderciclos,
        'filterModel' => $searchModelciclos,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Ciclos de cobros y pagos'],
       'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' =>  'Ciclos de cobros y pagos',
                    ]], 
        'caption'=>'Ciclos de cobros y pagos',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
            'group'=>true,  // enable grouping
             ],
                        [
               'attribute'=>'CE',
             'label'=>'Ciclo Cobro(Cuentas + Efectos)',
              //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ], 
                        [
                          'attribute'=>'CEL',
             'label'=>'Ciclo Cobro (Cuentas + Efectos) incluyendo los Litigios y Proc Jud',
              //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ],[
                          'attribute'=>'CELD',
             'label'=>'Ciclo Cobro (Cuentas + Efectos) incluyendo los Litigios y Proc Jud + Deuda del EMMP',
              //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM 
              ],
            [
                          'attribute'=>'CPCE',
             'label'=>'Ciclo Pago(Cuentas + Efectos)',                  
                //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ],
                        [
                          'attribute'=>'CPCE',
             'label'=>'Ciclo Pago(Cuentas + Efectos) incluyendo  Deuda del EMMP',                  
                //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM 
              ],
             [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
            
            //'id',
            //'empresaid',
            //'fecha',
            //'anexoid',

            
        ],
    ]); ?>
</div>
<div>
    <?=  GridView::widget([
        'dataProvider' => $dataProvidercomedor,
        'filterModel' => $searchModelcomedor,
       'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Analisis del Comedor'],
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' =>  'Analisis del Comedor',
                    ]], 
        'caption'=>'Analisis del Comedor',
       
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
           
            [
            
            'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'gastos',
                 'label'=>'Gastos',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
               'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        
                        
            [ 
                 'attribute'=>'ingresos',
                 'label'=>'Ingresos',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                                    
            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Utilidad o perdidad de comedor',
            'width'=>'120px',
            'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(3, $p) - $widget->col(2, $p);
         
                  },
             'format'=>['decimal', 2], 
        
            ],
             
                                  
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Gasto por peso de ingreso',
            'width'=>'120px',
            //'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(2, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(2, $p) / $widget->col(3, $p) ;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2],
            // 'pageSummary'=>true,  
             'pageSummaryFunc'=> GridView::F_SUM,
        
            ],
                                              [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento de cumplimiento',
            'width'=>'120px',
            //'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(2, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(2, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2],
            // 'pageSummary'=>true,  
             'pageSummaryFunc'=> GridView::F_AVG,
        
            ],
                           [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          

                        
                              
                   
                         ],
                          
                         
          'resizableColumns'=>true,
    ]);
            
            
             ?>
</div>
    
   <div class="cuentas-index">
    <?php 
    
    echo GridView::widget([
      'dataProvider' => $dataProvidercuentas1,
        'filterModel' => $searchModelcuentas1,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Cuentas por cobrar'],
       'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' =>  'Cuentas por cobrar',
                    ]], 
        'caption'=>'Cuentas por cobrar',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
            'group'=>true,  // enable grouping
             ],
             [
              'attribute'=>'nm_no_vencida',
             'label'=>'MN no vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                        [
                           'attribute'=>'mn_total_vencida',
             'label'=>'MN Total Vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'efectos',
             'label'=>'Efectos por cobrar',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'cxc_litigio',
             'label'=>'Cuentas por cobrar en litigio',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                         [
                           'attribute'=>'ExC_litigio',
             'label'=>'Efectos por cobrar en litigio',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                               [
                           'attribute'=>'saldo_sentencias_judiciales',
             'label'=>'Saldo de sentencias judiciales pendientes',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                            [
                           'attribute'=>'ventas_acumuladas',
             'label'=>'Ventas Acumuladas',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                           [
                           'attribute'=>'total_cuentas_vencidas',
             'label'=>'Total de cuentas vencidas',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                         [
                           'attribute'=>'efectiviadad',
             'label'=>'Efectividad del cobro',
              'format'=>['decimal', 2], 
               'width'=>'100px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'representatividad',
             'label'=>'Representatividad del total de cuentas por cobrar vencidad/Ventas acumuladas',
              'format'=>['decimal', 2], 
               'width'=>'120px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                         [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
         

        ],
    ]);
                
     echo GridView::widget([
      'dataProvider' => $dataProvidercuentas2,
        'filterModel' => $searchModelcuentas2,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Cuentas por pagar'],
        /*'exportConfig'=>[
        GridView::PDF=>['label'=>'Exportar como PDF',

        ]], */ 
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
               'group'=>true,  // enable grouping
             ],
             [
              'attribute'=>'nm_no_vencida',
             'label'=>'MN no vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                        [
                           'attribute'=>'mn_total_vencida',
             'label'=>'MN Total Vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'efectos',
             'label'=>'Efectos por cobrar',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                          [
                           'attribute'=>'efectiviadad',
             'label'=>'Efectividad del cobro',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                         [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
                            ],
    ]);
    

?>
</div>
<div class="fondo-salario-index">

   
    <?= GridView::widget([
        'dataProvider' => $dataProvidersalario,
        'filterModel' => $searchModelsalario,
       // 'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Fondo de Salario'],
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' =>  'Fondo de Salario',
                    ]], 
        'caption'=>'Fondo de Salario',
       'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
           
            [
            
         //   'pageSummary'=>'Consolidado Grupo',
         //   'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                 'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'plan_anterior',
                 'label'=>'Real del Año Anterior',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
           //      'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        
                        
            [ 
                 'attribute'=>'FSVA_plan',
                 'label'=>'Plan del Año Actual',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
             //    'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'FSVA_vreal',
                 'label'=>'Real del Año Actual',          
                 'width'=>'120px',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
               //  'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        

         
                          
            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al plan',
            'width'=>'120px',
           // 'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(4, $p) / $widget->col(3, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
             
                                  
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al año anterior',
            'width'=>'120px',
            //'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(2, $p) !=0)
                  {
                                                    return $widget->col(4, $p) / $widget->col(2, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2],
            // 'pageSummary'=>true,  
             'pageSummaryFunc'=> GridView::F_AVG,
        
            ],
                           [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          

                        
                              
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);?>
</div>

<div class="fondo-tiempo-index">

  
    

    <?= GridView::widget([
         'dataProvider' => $dataProvidertiempo,
        'filterModel' => $searchModeltiempo,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Indice de utilización el fondo de tiempo '],
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Indice de utilización el fondo de tiempo ',
                    ]], 
        'caption'=>'Indice de utilización el fondo de tiempo ',
      'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
           
            [
            
            'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                 'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'adiestrado',
                 'label'=>'Adiestrados',
                 'hAlign'=>'right',
                 //'format'=>['decimal', 4],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'indice_utilizacion',
                 'label'=>'Indice de Utilización',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_AVG             
            ],
                 [ 
                 'attribute'=>'indice_ausentismo',
                 'label'=>'Indice de Ausentismo',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_AVG             
            ],   
                         [ 
                 'attribute'=>'ausentismo_puro',
                 'label'=>'Ausentismo Puro',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_AVG             
            ], 
                                                 [ 
                 'attribute'=>'promedio_trab_mensual',
                 'label'=>'Promedio de Trabajadores Mensual',
                 'hAlign'=>'right',
                // 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM            
            ],
                         [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
               

        ],
    ]); ?>
</div>

<div class="informacion-laboratorios-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderlaboratorio,
    'filterModel' => $searchModellaboratorio,
    'showPageSummary'=>true,

  //  'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'success', 'heading'=>'Información de los Laboratorios'],
    'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Información de los Laboratorios',
                    ]], 
        'caption'=>'Información de los Laboratorios',
        'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],

        //'id',
        [
         'pageSummary'=>'Total',
        'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        'width'=>'305px',
            'attribute'=>'empresaid',
         'label'=>'Empresa',
            'value'=>function ($model, $key, $index, $widget) { 
                return $model->empresa->nombre;
            },
          'group'=>true,  // enable grouping
         ], 
                      [
          'attribute'=>'cant',
         'label'=>'Cantidad de Puntos de Control',
          //'format'=>['decimal', 2], 
           'width'=>'150px',
        'hAlign'=>'right', 
       'pageSummary'=>true,  
       'pageSummaryFunc'=> GridView::F_SUM     
         ],
                       [
          'attribute'=>'terminados',
         'label'=>'Terminados',
          //'format'=>['decimal', 2], 
           'width'=>'150px',
        'hAlign'=>'right', 
       'pageSummary'=>true,  
       'pageSummaryFunc'=> GridView::F_SUM     
         ],
                    [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento %',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(2, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(2, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
                                [
          'attribute'=>'cant_func',
         'label'=>'Funcionando',
          //'format'=>['decimal', 2], 
           'width'=>'150px',
        'hAlign'=>'right', 
       'pageSummary'=>true,  
       'pageSummaryFunc'=> GridView::F_SUM     
         ],
                                     [
          'attribute'=>'cant_no_func',
         'label'=>'Fuera de Servicio',
          //'format'=>['decimal', 2], 
           'width'=>'150px',
        'hAlign'=>'right', 
       'pageSummary'=>true,  
       'pageSummaryFunc'=> GridView::F_SUM     
         ],
            
           // 'porciento',
            //'cant_func',
            //'cant_no_func',
            //'fecha',
            //'anexoid',

         
        
                           [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
        ],                  
    ]); ?>
</div>

<div class="perdida-investigacion-index">
  
    <?= GridView::widget([
        'dataProvider' => $dataProviderperdida1,
        'filterModel' => $searchModelperdida1,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Expedientes de faltantes en investigación'],
         'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Expedientes de faltantes en investigación',
                    ]], 
        'caption'=>'Expedientes de faltantes en investigación',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
               'group'=>true,  // enable grouping
             ], 
                          [
              'attribute'=>'importe_total',
             'label'=>'Importe Total de la Cuenta',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                         [
              'attribute'=>'cant_expedientas',
             'label'=>'Cantidad de Expedientes',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],  
                   [
              'attribute'=>'fuera_termino',
             'label'=>'Expedientes fuera de terminos',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],    
                              [
              'attribute'=>'valor_fuera_termino',
             'label'=>'Valor de los Expediente Fuera de termino',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ], 
                         [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
         

           
        ],
    ]); ?>
</div>

<div class="perdida-investigacion-index">
  
    <?= GridView::widget([
        'dataProvider' => $dataProviderperdida2,
        'filterModel' => $searchModelperdida2,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Expedientes de perdidas en investigación'],
       'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Expedientes de perdidas en investigación',
                    ]], 
        'caption'=>'Expedientes de perdidas en investigación',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
              'group'=>true,  // enable grouping
             ], 
                          [
              'attribute'=>'importe_total',
             'label'=>'Importe Total de la Cuenta',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                         [
              'attribute'=>'cant_expedientas',
             'label'=>'Cantidad de Expedientes',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],  
                   [
              'attribute'=>'fuera_termino',
             'label'=>'Expedientes fuera de terminos',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],    
                              [
              'attribute'=>'valor_fuera_termino',
             'label'=>'Valor de los Expediente Fuera de termino',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],  
         
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                          
           
        ],
    ]); ?>
</div>

<div class="perdida-investigacion-index">
   <?= GridView::widget([
        'dataProvider' => $dataProviderperdida3,
        'filterModel' => $searchModelperdida3,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Expedientes de sobrantes en investigacion'],
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Expedientes de sobrantes en investigacion',
                    ]], 
        'caption'=>'Expedientes de sobrantes en investigacion',
        
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            //'id',
            [
             'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
                'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
             'group'=>true,  // enable grouping
             ], 
                          [
              'attribute'=>'importe_total',
             'label'=>'Importe Total de la Cuenta',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                         [
              'attribute'=>'cant_expedientas',
             'label'=>'Cantidad de Expedientes',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],  
                   [
              'attribute'=>'fuera_termino',
             'label'=>'Expedientes fuera de terminos',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],    
                              [
              'attribute'=>'valor_fuera_termino',
             'label'=>'Valor de los Expediente Fuera de termino',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ], 
                      
         
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      

           
        ],
    ]); ?>
</div>

<div class="productividad-index">
   
    
    <?= GridView::widget([
        'dataProvider' => $dataProviderproductividad,
        //'filterModel' => $searchModel,
       // 'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>' Productividad y Correlación Salario Medio / Productividad'],
         'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => ' Productividad y Correlación Salario Medio / Productividad',
                    ]], 
        'caption'=>' Productividad y Correlación Salario Medio / Productividad',
       'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
           
            [
            
         //   'pageSummary'=>'Consolidado Grupo',
         //   'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'plan_anterior',
                 'label'=>'Real del Año Anterior',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
           //      'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        
                        
            [ 
                 'attribute'=>'plan',
                 'label'=>'Plan del Año Actual',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
             //    'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'vreal',
                 'label'=>'Real del Año Actual',          
                 'width'=>'120px',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
               //  'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        

         
                          
            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al plan',
            'width'=>'120px',
           // 'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(4, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
             
                                  
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al año anterior',
            'width'=>'120px',
            //'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(2, $p) !=0)
                  {
                                                    return $widget->col(2, $p) / $widget->col(4, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
            // 'pageSummary'=>true,  
             'pageSummaryFunc'=> GridView::F_AVG,
        
            ],
                           [ 
                 'attribute'=>'correlacion',
                 'label'=>'Correlación salario medio -  productividad',          
                 'width'=>'120px',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
                 //'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                              
                              
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);    ?>
</div>

<div class="reclamaciones-index">
   
   

    <?= 
            GridView::widget([
         'dataProvider' => $dataProviderrecla,
        'filterModel' => $searchModelrecla,
        'showPageSummary'=>true,
     
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Reclamaciones'],
                'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => ' Reclamaciones',
                    ]], 
        'caption'=>' Reclamaciones',

       
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            [ 
                 'attribute'=>'tipo_reclamacion',
                 'label'=>'Reclamación',
                 'hAlign'=>'right',
                       'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipoReclamacion->tipo;
                },
                         'group'=>true,          
            ],
            
            [
            
            'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return frontend\controllers\EmpresaController::findModel($model->empresaid)->nombre;
                },
                 'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
                       
          [ 
                 'attribute'=>'cant_reclamacion',
                 'label'=>'Cantidad de reclamaciones',
                 'hAlign'=>'right',
                 //'format'=>['decimal', 4],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'importe_reclamacion',
                 'label'=>'Importe de las Reclamaciones',
                 'hAlign'=>'right',
                // 'format'=>['currency'],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'demanda_cant',
                 'label'=>'Cantidad de Demadas',
                 'hAlign'=>'right',
                // 'format'=>['currency'],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                  [ 
                 'attribute'=>'demanda_importe',
                 'label'=>'Importe de las demandas',
                 'hAlign'=>'right',
                // 'format'=>['currency'],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],   
                        
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      
          
        ],
    ]); ?>
</div>

<div class="utilidad-index">

  

    <?= GridView::widget([
        'dataProvider' => $dataProviderutilidad,
        'filterModel' => $searchModelutilidad,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Utilidad, Índice de Utilidad y Gasto por peso de ingreso </h3>',
        'type'=>'success',
            ],
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Utilidad, Índice de Utilidad y Gasto por peso de ingreso',
                    ]], 
        'caption'=>' Utilidad, Índice de Utilidad y Gasto por peso de ingreso',

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
             'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                'group'=>true,  // enable grouping
             ],
                                [
               'attribute'=>'real_anterior',
             'label'=>'Real del Año Anterior',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                          [
               'attribute'=>'plan_anual',
             'label'=>'Real del Año Actual',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                        [
               'attribute'=>'plan',
             'label'=>'Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                  [
               'attribute'=>'vreal',
             'label'=>'Valor Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ], 
                                      [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento Plan-Real',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(5, $p) / $widget->col(4, $p) ;
           
                  },
             'format'=>['decimal', 2], 
             /*'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  */
            ],
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Diferencia Plan-Real',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
         
                                                    return $widget->col(4, $p) - $widget->col(5, $p) ;
           
                  },
             'format'=>['decimal', 2], 
             /*'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM  */
            ], 
                           [
               'attribute'=>'real_acum_plan',
             'label'=>'Porciento Real Acumulado-Plan',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ], 
                                      [
               'attribute'=>'IPUI',
             'label'=>'Indice Plan  /Ingreso',
               'format'=>['decimal', 4],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ], 
                                      [
               'attribute'=>'IRUI',
             'label'=>'Indice Real Utilidad /Ingreso',
               'format'=>['decimal', 4],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                       [
               'attribute'=>'IPGI',
             'label'=>'Indice Plan Gasto /Ingreso',
               'format'=>['decimal', 4],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                           [
               'attribute'=>'IRGI',
             'label'=>'Indice Real Gasto /Ingreso',
               'format'=>['decimal', 4],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                          
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      
           

        ],
    ]); ?>
</div>

<div class="utilidadxpeso-index">
    
    
   
    <?=
            GridView::widget([
        'dataProvider' => $dataProviderutixpeso,
        'filterModel' => $searchModelutixpeso,
       // 'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Utilidad por peso de valor agregado'],
        
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Utilidad por peso de valor agregado',
                    ]], 
        'caption'=>' Utilidad por peso de valor agregado',

        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
           
            [
            
         //   'pageSummary'=>'Consolidado Grupo',
         //   'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
               'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'plan_anterior',
                 'label'=>'Real del Año Anterior',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
           //      'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        
                        
            [ 
                 'attribute'=>'UPVA_plan',
                 'label'=>'Plan del Año Actual',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
             //    'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'UPVA_vreal',
                 'label'=>'Real del Año Actual',          
                 'width'=>'120px',
                 'hAlign'=>'right',
                 'format'=>['decimal', 4],
               //  'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        

         
                          
            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al plan',
            'width'=>'120px',
           // 'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(4, $p) / $widget->col(3, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
             
                                  
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al año anterior',
            'width'=>'120px',
            //'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(2, $p) !=0)
                  {
                                                    return $widget->col(4, $p) / $widget->col(2, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2],
            // 'pageSummary'=>true,  
             'pageSummaryFunc'=> GridView::F_AVG,
        
            ],

 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      
                        
                              
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);
            

?>
 
</div>

<div class="valor-agregado-index">
   
    

    <?= GridView::widget([
        'dataProvider' => $dataProvidervalor,
        'filterModel' => $searchModelvalor,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Valor Agregado bruto'],
        
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Valor Agregado bruto',
                    ]], 
        'caption'=>'Valor Agregado bruto',

        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
           
            [
            
            'pageSummary'=>'Consolidado Grupo',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'plan_anterior',
                 'label'=>'Real del Año Anterior',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        
                        
            [ 
                 'attribute'=>'plan',
                 'label'=>'Plan del Año Actual',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'vreal',
                 'label'=>'Real del Año Actual',          
                 'width'=>'120px',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        

         
                          
            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al plan',
            'width'=>'120px',
           // 'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(4, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
                                  
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento con respecto al año anterior',
            'width'=>'120px',
            //'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(2, $p) !=0)
                  {
                                                    return $widget->col(2, $p) / $widget->col(4, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
            // 'pageSummary'=>true,  
             'pageSummaryFunc'=> GridView::F_AVG,
        
            ],
                     
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                               
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);   
                  ?>
</div>

<div class="variacion-gastos-index">
   
    <hr> <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?php        
                  
                  
         echo   GridView::widget([
        'dataProvider' => $dataProvidervariacion,
        'filterModel' => $searchModelvariacion,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Variación de los gastos'],
        
        'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Variación de los gastos',
                    ]], 
        'caption'=>'Variación de los gastos',
 
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
   
            [
            'attribute'=>'periodo',
            'label' => 'Periodo',
            'group'=>true,  // enable grouping,
            'groupedRow'=>true, 
                               // move grouped column to a single grouped row
            'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass'=>'kv-grouped-row'   
            
            ],
            
            [
            
            'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                 'group'=>true,  // enable grouping
            'subGroupOf'=>1 // supplier column index is the parent group
        ],
          [ 
                 'attribute'=>'gastosxperdida',
                 'width'=>'120px',
                 'hAlign'=>'right',
                 'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'gastosxfaltante',
                 'label'=>'Gastos por Faltantes',           
                 'width'=>'120px',
                 'hAlign'=>'right',
                  'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        

         [
             'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Total',
            'width'=>'120px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          
                                                    return $widget->col(3, $p) + $widget->col(4, $p);
           
                  },
             'format'=>['decimal', 2], 
            'pageSummary'=>true
        ],

        
      // 'fecha',
                          [ 
                 'attribute'=>'gastosxperdida',
                 'label'=> 'Gastos por Perdida Año Anterior',
                 'value'=> function ($model, $key, $index, $widget)
                 {
                  
                  $anho = str_replace(substr($model->periodo,0, 4),substr($model->periodo,0, 4)+1,$model->periodo);
                   $modelnew = frontend\models\VariacionGastos::find()->filterWhere(['empresaid'=>$model->empresaid,'periodo'=> $anho])->one();
                
                  return $modelnew->gastosxperdida;
                 },
                 'width'=>'150px',
                 'hAlign'=>'right',
                 'options'=>['class'=>'kv-grid-group kv-group-odd'],
                'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                         
                          [ 
                 'attribute'=>'gastosxfaltante',
                 'label'=> 'Gastos por Faltante Año Anterior',
                 'value'=> function ($model, $key, $index, $widget)
                 {
                  
                  $anho = str_replace(substr($model->periodo,0, 4),substr($model->periodo,0, 4)+1,$model->periodo);
                   $modelnew = frontend\models\VariacionGastos::find()->filterWhere(['empresaid'=>$model->empresaid,'periodo'=> $anho])->one();
                
                  return $modelnew->gastosxfaltante;
                 },
                 'width'=>'120px',
                 'hAlign'=>'right',
                'format'=>['decimal', 2],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ], 
           [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Total',
            'width'=>'120px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          
                                                    return $widget->col(6, $p) + $widget->col(7, $p);
           
                  },
             'format'=>['decimal', 2], 
            'pageSummary'=>true
       
        
            ],

                            [
             'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Gastos por Perdida (Variación)',
            'width'=>'120px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          
                                                    return $widget->col(3, $p) - $widget->col(6, $p);
           
                  },
             'format'=>['decimal', 2], 
            'pageSummary'=>true
        ],
                                [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento %',
            'width'=>'120px',
                                    'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(6, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(6, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
                                  [
             'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Gastos por Faltantes (Variación)',
            'width'=>'120px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          
                                                    return $widget->col(4, $p) - $widget->col(7, $p);
           
                  },
             'format'=>['decimal', 2], 
            'pageSummary'=>true
        ],   
                                 [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento %',
            'width'=>'120px',
            'pageSummary'=>true,
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(7, $p) !=0)
                  {
                                                    return $widget->col(4, $p) / $widget->col(7, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
                                             [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Total',
            'width'=>'120px',
            'hAlign'=>'right',
            'pageSummary'=>true,
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
        return $widget->col(9, $p) + $widget->col(11, $p);  
                  },
             'format'=>['decimal', 2], 
        
            ],
                          
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);       
                 
                  
                  
                  
                  ?>
</div>

<div class="ventas-index">
   
    <?php 
    
    echo GridView::widget([
       'dataProvider' => $dataProviderventas1,
        'filterModel' => $searchModelventas1,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Ventas del mercado paralelo </h3>',
        'type'=>'success',
            ],
         'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Ventas del mercado paralelo',
                    ]], 
        'caption'=>'Ventas del mercado paralelo',
 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
             'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
               'group'=>true,  // enable grouping
             ],
              [
               'attribute'=>'productoid',
             'label'=>'Producto',
             'value'=> function ($model)
                            {
                               return $model->producto->producto; 
        
                          }, 
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Producto::find()->orderBy('id')->asArray()->all(), 'id', 'producto'), 
                'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione Producto'],
                'group'=>true,  
              ],
                      [
               'attribute'=>'plan',
             'label'=>'Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                [
               'attribute'=>'vreal',
             'label'=>'Valor Real',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
              ],
         [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento %',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(4, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
            [
                'attribute'=>'fecha',
                'label' => 'Periodo',
              'width'=>'150px',
            'hAlign'=>'right',
                
            ]    ,
                          
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      
            
            //'tipo_ventaid',
           
            //'fecha',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>
</div>
<div>
                  
<?php    echo GridView::widget([
       'dataProvider' => $dataProviderventas3,
        'filterModel' => $searchModelventas3,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Ventas Netas </h3>',
        'type'=>'success',
            ],
    
         'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Ventas Netas',
                    ]], 
        'caption'=>'Ventas Netas',
 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
             'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
                
                'group'=>true,  // enable grouping
             ],
              [
               'attribute'=>'productoid',
             'label'=>'Producto',
             'value'=> function ($model)
                            {
                               return $model->producto->producto; 
        
                          }, 
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Producto::find()->orderBy('id')->asArray()->all(), 'id', 'producto'), 
                'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione Producto'],
                'group'=>true,   
              ],
                      [
               'attribute'=>'plan',
             'label'=>'Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                [
               'attribute'=>'vreal',
             'label'=>'Valor Real',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
              ],
         [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento %',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(4, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(4, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
            [
                'attribute'=>'fecha',
                'label' => 'Periodo',
              'width'=>'150px',
            'hAlign'=>'right',
                
            ] ,
                          
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                      
            
            //'tipo_ventaid',
           
            //'fecha',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>
</div>
    <div>
                 
        <?php echo GridView::widget([
       'dataProvider' => $dataProviderventas2,
        'filterModel' => $searchModelventas2,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Ventas liberadas </h3>',
        'type'=>'success',
            ],
            
         'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF', 
                    'filename' => 'Ventas liberadas',
                    ]], 
        'caption'=>'Ventas liberadas',
 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
             'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->empresa->nombre;
                },
             'group'=>true,  // enable grouping
             ],
                   [
               'attribute'=>'plan',
             'label'=>'Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],                     [
               'attribute'=>'vreal',
             'label'=>'Valor Real',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
              ], 
                            [
            'class' => '\kartik\grid\FormulaColumn',
            'header'=>'Porciento respecto al plan',
            'width'=>'150px',
            'hAlign'=>'right',
            'value' => function ($model, $key, $index, $widget) {
                                                     $p = compact('model', 'key', 'index');
                                                      // Write your formula below
          if($widget->col(2, $p)!= 0 && $widget->col(3, $p) !=0)
                  {
                                                    return $widget->col(3, $p) / $widget->col(2, $p) * 100;
            }
            else                return 0;
                  },
             'format'=>['decimal', 2], 
        
            ],
                 
 [
               'attribute'=>'fecha',
             'label'=>'Periodo',
             // 'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right',                      
             'value' => function ($model, $key, $index, $widget) {

         
                                                    return \Yii::$app->formatter->asDate($model->fecha,'M-Y')  ;
                                                  
           
                  },
            
                                                   ],                
                             
                        
                        
                 ],
    ]);         
        
    ?>
</div>


