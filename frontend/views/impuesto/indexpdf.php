<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ImpuestoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Impuestos');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="impuesto-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
   

  //  'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'success', 'heading'=>'Anexo Cumplimiento de los impuestos'],
    /*'exportConfig'=>[
    GridView::PDF=>['label'=>'Exportar como PDF',

    ]], */ 
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],

        //'id',
        [
        
     
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
               'attribute'=>'venta35_plan',
             'label'=>'Impuestos por la venta al 35 % Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                         [
               'attribute'=>'ventas35_vreal',
             'label'=>'Impuestos por la venta al 35 % Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                               [
               'attribute'=>'ventas2_plan',
             'label'=>'Impuesto de ventas 2% Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                             [
               'attribute'=>'ventas2_vreal',
             'label'=>'Impuesto de ventas 2% Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                   [
               'attribute'=>'especial17_real2',
             'label'=>'Impuesto especial al 17% Planeado',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                                           [
               'attribute'=>'especial17_vreal',
             'label'=>'Impuesto especial al 17% Real',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                           [
               'attribute'=>'recuperacion_plan',
             'label'=>'Importe de recuperación al 24% Planeado  ',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
                              [
               'attribute'=>'recupercion_vreal',
             'label'=>'Importe de recuperación al 24% Real  ',
               'format'=>['decimal', 2],  
                'width'=>'150px',
            'hAlign'=>'right',           
              ],
           
            
          
           
        ],
    ]); ?>
</div>
