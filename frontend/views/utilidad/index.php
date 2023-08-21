<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UtilidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Utilidad, Índice de Utilidad y Gasto por peso de ingreso');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="utilidad-index">

  

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-eye-open"></i> Anexo </h3>',
        'type'=>'primary',
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
           

        ],
    ]); ?>
</div>
