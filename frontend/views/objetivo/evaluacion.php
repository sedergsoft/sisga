<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObjetivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluacion de los Objetivos');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="objetivo-index">
   
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

     <?php
     
     
     echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Objetivos</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
       ///  'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
           
//'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
          'exportConfig'=>[
        GridView::PDF=>['label'=>'Exportar como PDF',

        ]], 
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           /* [
            'attribute'=>'nombre',
            'label' => 'Nombre',
            
            ],*/
            [
             'attribute'=>'abreviatura',
            'label' => 'Abreviatura',   
            ],
              [
             'attribute'=>'descripcion',
            'label' => 'Descripción',   
            ],
            /* [
            'attribute'=>'fechaAct',
            'label' => 'Fecha de Activacion',
            
            ],*/
            [
            'attribute'=>'fechaAct',
            'label' => 'Fecha de Activacion',
            
            ],
            [
            'attribute'=>'responsable0.nombre',
            'label' => 'Responsable',
            
            ],
              [
             //'attribute'=>'empresaid',
             'class' => '\kartik\grid\DataColumn',
                'label' => 'evaluacion',
                'format'=>'raw',  
                'value' => function ($model, $key, $index, $widget) 
                  {
                    $evaluacion = frontend\controllers\ObjetivoController::EvaluaciondelObjetivo($model->id); 
                     if($evaluacion == 'retroceso')
                     {
                         return '<span class="badge badge-success" style="background-color:#d41a1a">En retroceso</span>';
                     }
                      if($evaluacion == 'avance')
                     {
                         return '<span class="badge badge-success" style="background-color:#5475ED"> En avance</span>';
                     }
                       if($evaluacion == 'estancado')
                     {
                         return '<span class="badge badge-success" style="background-color:#648e6e"> Estancado</span>';
                     }
                  //  return 

                  }
             
                   ],
          
        ],
    ]); 
   ?>
</div>
