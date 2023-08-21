<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Analisis de ventas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="ventas-index">
   
    <?php 
     echo GridView::widget([
       'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Anexo </h3>',
       'type'=>'primary',
            'before'=>Html::a('<i class="glyphicon glyphicon-signal"></i> Mostrar Grafico', ['mostrargrafico','id'=> 3], ['class' => 'btn btn-info']),
     ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
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
                                                    return $widget->col(4, $p) / $widget->col(3, $p) * 100;
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
                'group'=>true
                
            ]                                                         
            
            //'tipo_ventaid',
           
            //'fecha',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>
</div>
