<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReclamacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reclamaciones');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="reclamaciones-index">
   
   

    <?= 
            GridView::widget([
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
                 'attribute'=>'tipo_reclamacion',
                 'label'=>'Reclamacion',
                 'hAlign'=>'right',
                       'value'=>function ($model, $key, $index, $widget) { 
                    return $model->tipoReclamacion->tipo;
                },
                         'group'=>true,  // enable grouping
                // 'format'=>['currency'],
                // 'pageSummary'=>true,  
                // 'pageSummaryFunc'=> GridView::F_SUM             
            ],
            
            [
            
            'pageSummary'=>'Total',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            'width'=>'305px',
           'attribute'=>'empresaid',
             'label'=>'Empresa',
                'value'=>function ($model, $key, $index, $widget) { 
                    return frontend\controllers\EmpresaController::findModel($model->empresaid)->nombre;
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
                 'attribute'=>'cant_reclamacion',
                 'label'=>'Cantidad de reclamaciones',
                 'hAlign'=>'right',
                 //'format'=>['decimal', 4],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'importe_reclamacion',
                 'label'=>'Importe de las Reclamaciones',
                 'hAlign'=>'right',
                // 'format'=>['currency'],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                        [ 
                 'attribute'=>'demanda_cant',
                 'label'=>'Cantidad de Demadas',
                 'hAlign'=>'right',
                // 'format'=>['currency'],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],
                  [ 
                 'attribute'=>'demanda_importe',
                 'label'=>'Importe de las demandas',
                 'hAlign'=>'right',
                // 'format'=>['currency'],
                 'pageSummary'=>true,  
                 'pageSummaryFunc'=> GridView::F_SUM             
            ],   
            
          /*  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cant_reclamacion',
            'importe_reclamacion',
            'demanda_cant',
            'demanda_importe',
            //'anexoid',
            //'fecha',
            //'tipo_reclamacion',
            //'empresaid',

            ['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>
</div>
