<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObjetivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objetivos');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="objetivo-index">
   
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

     <?php
     
     if(Yii::$app->user->identity->rolid == "2")
     {
     
     echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Objetivos</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
         'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
           
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

            [
            'attribute'=>'nombre',
            'label' => 'Nombre',
            
            ],
            [
             'attribute'=>'abreviatura',
            'label' => 'Abreviatura',   
            ],
              [
             'attribute'=>'descripcion',
            'label' => 'Descripción',   
            ],
             [
            'attribute'=>'fechaAct',
            'label' => 'Fecha de Activacion',
            
            ],
            [
            'attribute'=>'responsable0.nombre',
            'label' => 'Responsable',
            
            ],
           
            ['class' => 'yii\grid\ActionColumn',
              'template' => '{view}',   
                ],
        ],
    ]); 
    }
    else{
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Objetivos</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        // 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
           
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

            [
            'attribute'=>'nombre',
            'label' => 'Nombre',
            
            ],
            [
             'attribute'=>'abreviatura',
            'label' => 'Abreviatura',   
            ],
              [
             'attribute'=>'descripcion',
            'label' => 'Descripción',   
            ],
             [
            'attribute'=>'fechaAct',
            'label' => 'Fecha de Activacion',
            
            ],
            [
            'attribute'=>'responsable0.nombre',
            'label' => 'Responsable',
            
            ],
           
            ['class' => 'yii\grid\ActionColumn',
              'template' => '{view}',   
                ],
        ],
    ]);
        
    }
    

        
   /* ?>    
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'nombre',
            'abreviatura',
            'descripcion:ntext',
            'fechaAct',
            'responsable0.nombre',
            //'Status',
            //'fechaDesac',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
</div>
