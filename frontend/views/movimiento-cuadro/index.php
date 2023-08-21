<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MovimientoCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Propuestas de Movimiento de Cuadros');
$this->params['breadcrumbs'][] = $this->title;

$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this); 
?>
<div class="movimiento-cuadro-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
              /* 'toolbar' =>  [
        ['content' => 
           // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => 'Agregar Indicador']). ' '.
            Html::a('<i class="glyphicon glyphicon-ok-sign"></i>', ['activarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-info', 'title' => 'Activar periodo de edicion de los Indicadores','data-confirm'=>'Está seguro de querer activar el periodo de edición de los indicadores de gestión?'])  . ' '.
           // Html::button('<i class="glyphicon glyphicon-minus-sign"></i>', ['value'=>Url::to(['indicadoresgestion/cerrarperiodoevaluacion']),'type' => 'button', 'title' => 'Cerrar periodo de evaluacion', 'class' => 'btn btn-danger','data-confirm'=>'Está seguro de querer cerrar el periodo de edicion de los indicadores de gestión?'])
            Html::a('<i class="glyphicon glyphicon-minus-sign"></i>', ['cerrarperiodoevaluacion'], ['data-pjax' => 0, 'class' => 'btn btn-danger', 'title' => 'Cerrar periodo de edicion de los Indicadores','data-confirm'=>'Está seguro de querer cerrar el periodo de edición de los indicadores de gestión?']). ' '. 
            Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['cerrarmes'], ['data-pjax' => 0, 'class' => 'btn btn-warning', 'title' => 'Cerrar la información del mes','data-confirm'=>'Está seguro de querer cerrar el mes?...Tenga en cuenta que con esta acción reiniciara todas las evaluaciones de los indicadores']) 
        ],
        '{export}',
        '{toggleData}',
    ],*/
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Propuestas de Movimientos Pendientes </h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
       // 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
           ],
        /*'toolbar'=>[
        '{toggleData}'
    ],*/'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'sintesis_biografica',
            //'resultados_controles',
            //'fundamentacion',
            //'consideraciones',
            'entidad',
            'tipoMovimiento.tipo_movimiento',
            'causas_sustitucion',
            //'idcargo_propuesto',
 [
      'attribute'=>'cuadro.personaCI0.Nombre',
      'label' => 'Cuadro Sustituto'
            ,
 ],       
 [
      'attribute'=>'cuadroSustituido.personaCI0.Nombre',
      'label' => 'Cuadro Sustituido',
            
 ],       
            
            //'evaluacion_cuadroid',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view} {aprobar} {denegar}',
             'buttons'=>[
                            'aprobar'=> function($url,$data)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-ok" style="right: -10px;color:green";></span',
                                                                            $url = Url::toRoute(['movimiento-cuadro/aprobar', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Aprobar Propuesta ',
                                                                                 'data-confirm'=> 'Esta seguro que desea aprobar la propuesta de Moviemiento'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                            'denegar'=> function($url,$data)
                                        {
                                       
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-remove" style="right: -20px;color:red";></span',
                                                                            $url = Url::toRoute(['movimiento-cuadro/denegar', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Rechazar Propuesta ',
                                                                                 'data-confirm'=> 'Esta seguro que desea rechazar la propuesta de movimiento',
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],    
                                        
                        ]   
                
                
            ],
        
    ]); ?>
</div>
