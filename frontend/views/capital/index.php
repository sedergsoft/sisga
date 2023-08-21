<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CapitalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Análisis del Capital de Trabajo (Periodo '.$periodo.' )');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="capital-index">
   


    <?= GridView::widget([
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
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Empresa::find()->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione Empresa'],
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
                          
            
            //'fecha',

           
        ],
    ]); ?>
</div>
