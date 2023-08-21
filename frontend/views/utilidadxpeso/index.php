<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UtilidadxpesoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Utilidad por peso de Valor Agregado Bruto');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="utilidadxpeso-index">
    
    
   
    <?=
            GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       // 'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'Anexos'],
        /*'exportConfig'=>[
        GridView::PDF=>['label'=>'Exportar como PDF',

        ]], */ 
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

                        
                              
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);
            
            
            GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'UPVA_vreal',
            'UPVA_plan',
            'fecha',
            'empresaid',
            //'plan_anterior',
            //'anexoid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
