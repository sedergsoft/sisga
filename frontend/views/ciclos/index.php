<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CiclosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ciclos de Cobros y Pagos incluyendo la totalidad de las deudas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="ciclos-index">
    
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

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
               'attribute'=>'CE',
             'label'=>'Ciclo Cobro(Cuentas + Efectos)',
              //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ], 
                        [
                          'attribute'=>'CEL',
             'label'=>'Ciclo Cobro (Cuentas + Efectos) incluyendo los Litigios y Proc Jud',
              //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ],[
                          'attribute'=>'CELD',
             'label'=>'Ciclo Cobro (Cuentas + Efectos) incluyendo los Litigios y Proc Jud + Deuda del EMMP',
              //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM 
              ],
            [
                          'attribute'=>'CPCE',
             'label'=>'Ciclo Pago(Cuentas + Efectos)',                  
                //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM  
              ],
                        [
                          'attribute'=>'CPCE',
             'label'=>'Ciclo Pago(Cuentas + Efectos) incluyendo  Deuda del EMMP',                  
                //'format'=>['decimal', 2], 
               'width'=>'150px',
            'hAlign'=>'right', 
           'pageSummary'=>true,  
           'pageSummaryFunc'=> GridView::F_SUM 
              ],
            
            
            //'id',
            //'empresaid',
            //'fecha',
            //'anexoid',

            
        ],
    ]); ?>
</div>
