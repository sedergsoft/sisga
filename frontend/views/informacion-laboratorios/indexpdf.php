<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InformacionLaboratoriosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Informacion Laboratorios');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="informacion-laboratorios-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'showPageSummary'=>true,

  //  'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'primary', 'heading'=>'Anexos Información Laboratorios'],
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

         
        ],
    ]); ?>
</div>
