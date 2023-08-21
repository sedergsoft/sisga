<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CuentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ucwords($tipocuenta->tipoCuenta->tipo));
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="cuentas-index">
    
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php 
    
    if($tipocuenta->tipoCuenta->id == 1)
    {
    
    echo GridView::widget([
      'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Anexo Cuentas por cobrar'],
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
              'attribute'=>'nm_no_vencida',
             'label'=>'MN no vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                        [
                           'attribute'=>'mn_total_vencida',
             'label'=>'MN Total Vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'efectos',
             'label'=>'Efectos por cobrar',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'cxc_litigio',
             'label'=>'Cuentas por cobrar en litigio',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                         [
                           'attribute'=>'ExC_litigio',
             'label'=>'Efectos por cobrar en litigio',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                               [
                           'attribute'=>'saldo_sentencias_judiciales',
             'label'=>'Saldo de sentencias judiciales pendientes',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                            [
                           'attribute'=>'ventas_acumuladas',
             'label'=>'Ventas Acumuladas',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                           [
                           'attribute'=>'total_cuentas_vencidas',
             'label'=>'Total de cuentas vencidas',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                         [
                           'attribute'=>'efectiviadad',
             'label'=>'Efectividad del cobro',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'representatividad',
             'label'=>'Representatividad del total de cuentas por cobrar vencidad/Ventas acumuladas',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
            
            //'empresaid',
            //'cxc_litigio',
            //'nm_no_vencida',
            //'efectos',
            //'mn_total_vencida',
            //'ExC_litigio',
            //'ventas_acumuladas',
            //'fecha',
            //'tipo_cuentaid',
            //'efectiviadad',
            //'vencidas',
            //'anexoid',

        ],
    ]);}
 else {
     echo GridView::widget([
      'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'showPageSummary'=>true,
            
      //  'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'success', 'heading'=>'Anexo cuentas por pagas'],
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
              'attribute'=>'nm_no_vencida',
             'label'=>'MN no vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM     
             ],
                        [
                           'attribute'=>'mn_total_vencida',
             'label'=>'MN Total Vencida',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                        [
                           'attribute'=>'efectos',
             'label'=>'Efectos por cobrar',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                          [
                           'attribute'=>'efectiviadad',
             'label'=>'Efectividad del cobro',
              'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM      
                        ],
                            ],
    ]);
    
}
?>
</div>
