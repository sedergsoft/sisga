<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PerdidaInvestigacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expedientes '.ucwords($expediente->tipoExpediente->tipo).' En Investigacion');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="perdida-investigacion-index">
  
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Expedientes '.ucwords($expediente->tipoExpediente->tipo).' En Investigacion'],
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
         

           
        ],
    ]); ?>
</div>
