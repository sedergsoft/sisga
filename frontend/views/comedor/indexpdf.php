<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ComedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Análisis del Comedor ');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="comedor-index">
   

    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
       'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'Anexo Analisis del comedor'],
        /*'exportConfig'=>[
        GridView::PDF=>['label'=>'Exportar como PDF',

        ]], */ 
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
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Empresa::find()->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione Empresa'],
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
        
            ]

                        
                              
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);
            
            
             ?>
</div>
