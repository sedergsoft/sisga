<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productividad y Correlación Salario Medio / Productividad');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="productividad-index">
   
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
       // 'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Anexo Productividad y Correlación Salario Medio / Productividad'],
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
                        
                              
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);    ?>
</div>
