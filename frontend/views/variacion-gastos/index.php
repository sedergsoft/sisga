<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VariacionGastosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Variación Gastos');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="variacion-gastos-index">
   
    <hr> <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?php        
                  
                  
         echo   GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
            
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
                  
                  $anho = str_replace(substr($model->periodo,0, 4),substr($model->periodo,0, 4)-1,$model->periodo);
                   $modelnew = frontend\models\VariacionGastos::find()->filterWhere(['empresaid'=>$model->empresaid,'periodo'=> '2018-07','anexoid'=>$model->anexoid])->one();
                
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
                  
                  $anho = str_replace(substr($model->periodo,0, 4),substr($model->periodo,0, 4)-1,$model->periodo);
                   $modelnew = frontend\models\VariacionGastos::find()->filterWhere(['empresaid'=>$model->empresaid,'periodo'=> '2018-07','anexoid'=>$model->anexoid])->one();
                
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
                   
                         ],
                         
          'resizableColumns'=>true,
    ]);       
                 
                  
                  
                  
                  ?>
</div>
