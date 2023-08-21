<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluación de los Criterios de medida');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;

?>
<div class="evaluacion-index">
   
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <?php
    //Se activa si se registra una actualización en el AreasController.
     if(Yii::$app->session->hasFlash("ok_certificado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => "La información del Criterio de medida ".Yii::$app->session->getFlash("ok_certificado"). " ha sido certificada por usted correctamente."]);
        ?>
    <?php endif; ?>
  

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Información de los criterios de medida a certificar </h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
              [
             'attribute'=>'criteriomedidaid',
                'label'=>'Criterio de Medida',
                'value'=> function ($data)
                  {
        
             return \frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($data['criteriomedidaid']);   
            
                }
           ],
            'valor_vreal',
            
            [
                'attribute'=>'direccionid',
                'label'=>'Dirección que Informó',
                'value'=> function ($data)
           {
                    return   frontend\controllers\EvaluacionController::findModel($data['id'])->direccion->nombre;
           }
                ],
          'fechacreado',
           //'criteriomedidaid',
            //'estado',
            //'periodo',
            //'userid',
            //'observaciones:ntext',

            ['class' => 'yii\grid\ActionColumn',
                              
       'template' => '{view} {certificar}',
             'buttons' => [
                     'view' => function ($url, $data){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-eye-open" style="right: 0px";></span',
                                                                            $url = Url::toRoute(['evaluacion/view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Ver ',
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                   
                ],] ,
        ],
    ]); ?>
</div>
