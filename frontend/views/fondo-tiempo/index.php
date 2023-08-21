<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FondoTiempoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fondo Tiempo');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>


 <p>
        <?= Html::a(Yii::t('app', 'crear pdf'), ['exportar','id'=>$id], ['class' => 'btn btn-success']) ?>
    </p>
<div class="fondo-tiempo-index">

  
    

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
               

        ],
    ]); ?>
</div>
