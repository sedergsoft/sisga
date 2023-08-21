<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Alert;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CumplimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Certificar Indicadores de Gestión');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="cumplimiento-index">
   
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    //Se activa si se registra una actualización en el AreasController.
     if(Yii::$app->session->hasFlash("ok_certificado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => "La informacion del indicador ".Yii::$app->session->getFlash("ok_certificado"). " ha sido certificada por usted correctamente."]);
        ?>
    <?php endif; ?>


<?php
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Indicadores  de Gestión para certificar</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
       // 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
       // 'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>true,
    ],
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'indicadores_gestionid',
            'label' => 'Indicador',
                'width'=>'12px',
           'value'=> function ($data)
             {
              return "Ind. ".frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($data['indicadores_gestionid']);
             }
            
            ],
                   [
            'attribute'=>'descripcion',
            'label' => 'Descripción',
           'value'=> function ($data)
             {
              return frontend\controllers\IndicadoresgestionController::findModel($data['indicadores_gestionid'])->descripcion;
             }
            
            ], 
            [
            'attribute'=>'valor',
            'label' => 'Valor',
             'width'=>'12px',
            
            ],
                    
                    [
            'attribute'=>'fecha',
            'label' => 'Mes',
           'value'=> function ($data)
             {
             
                 return $mes = Yii::$app->formatter->asMont(substr($data['fecha'], 5, 2)); 
             
              //return $data['fecha'] ;
             }
            
            ], 
             [
            'attribute'=>'userid',
            'label' => 'Usuario que Informo',
                'width'=>'100px',     
            'value'=> function ($data)
             {
              $usuario = \frontend\controllers\UserController::findModel($data['userid']);
              return $usuario->username; 
             }     
            
            ],
            
           
            ['class' => 'yii\grid\ActionColumn',
                
       'template' => '{view} {certificar}',
             'buttons' => [
                     'view' => function ($url, $data){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-eye-open" style="right: 0px";></span',
                                                                            $url = Url::toRoute(['cumplimiento/view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Ver ',
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                      'certificar' => function ($url, $data){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-ok" style="right: -10px";></span',
                                                                            $url = Url::toRoute(['cumplimiento/certificar', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Certificar Información ',
                                                                                 'data-confirm'=> 'Esta seguro que desea certificar esta información'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],
        ],],
    ]);?>
  
</div>
