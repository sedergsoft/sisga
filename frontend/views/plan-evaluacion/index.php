<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProyeccionSearchPlanEvaluacion */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Plan de Evaluación');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="plan-evaluacion-index">

   
   

    <?= GridView::widget([
           'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-random"></i>   Plan de Evaluación </h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
             'attribute'=>'idevaluador',
                //'label'=>'Usuario',
                'group'=> TRUE,
                'value'=> function ($model)
                  {
        
             return frontend\controllers\UserController::findModel([$model->idevaluador])->username;   
                  }
               
           ],
                   
                   
                   [
             'attribute'=>'idcuadro',
                //'label'=>'Usuario',
                'value'=> function ($model)
                  {
                                     
             return frontend\controllers\CuadroController::nombreCuadro($model->idcuadro);   
                  }
                                 
           ],
           [
             'attribute'=>'idcuadro',
                'label'=>'N.I.',
                'value'=> function ($model)
                  {
                   
               
                    
             return frontend\controllers\CuadroController::findModel($model->idcuadro)->personaCI;   
                  }
               
           ],  
            [
             'attribute'=>'idcuadro',
                'label'=>'Cargo',
                'value'=> function ($model)
                  {
                   
               
                    
             return frontend\controllers\CuadroController::findModel($model->idcuadro)->cargo->cargo;   
                  }
               
           ],  
            'fecha',
           // 'observaciones',
           [
             'attribute'=>'status',
              'label'=> ' ¿Evaluado?',
              'value'=>  function ($model){
             return             $model->status ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
                    'format'=>'raw',
           ],
            //'observaciones',

            ['class' => 'yii\grid\ActionColumn',
             // 'width' => '50px',  
                
                     'template' => '{view} ',
                'buttons' => [
                    
                     'view' => function ($url, $data){
               
                           
                     return Html::a(
                                '<span class = "glyphicon glyphicon-eye-open";></span',
                                $url = Url::toRoute(['view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Ver Plan de Evaluación ',
                                                                                 'class' => 'btn btn-primary btn-xs', 
                                                                                 'style'=>"margin-left: 10px",
                                                                               
                                                                             ] 
                                 ); 
              
                          },
                                  ]
                
            
                ],
        ],
    ]); ?>
</div>
